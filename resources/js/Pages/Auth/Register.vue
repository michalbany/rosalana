<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Checkbox } from '@/Components/ui/checkbox';
import { computed, ref } from 'vue';

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
    tos: false,
});

const passwordshow = ref(false);

const schema = computed(() => ({
    first_name: 'required|alphaSpaces',
    last_name: 'required|alphaSpaces',
    email: 'required|email',
    username: 'required|alpha_dash',
    password: 'required|min:8',
    password_confirmation: 'passwordMismatch:@password',
    tos: 'tos',
}));

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Registrace" />

        <template #header>
            Registrace
        </template>

        <template #nav-button>
            <Button
            :as="Link"
            :href="route('login')"
            size="action"
            variant="action">
                <p>Přihlásit se</p>
            </Button>
        </template>


        <VeeForm 
            @submit="submit" 
            :validation-schema="schema"
            class="mt-8 sm:mt-10 max-w-md"
            >
            
            <InputError class="my-2" :message="form.errors.email" /> <!-- @change Přidat pro všechny jako odpovědi serveru -->
            
            
            <div class="flex justify-between flex-col lg:flex-row">
                <div class="relative mb-8" v-auto-animate>
                    <VeeField
                    v-model="form.first_name"
                    name="first_name"
                    type="text"
                    :as="Input"
                    placeholder="Jméno"
                    class="py-6 px-4"
                    autofocus
                    />
                    
                    <ErrorMessage name="first_name" class="mt-1 absolute text-destructive text-sm" />
                </div>
                
                <div class="relative mb-8" v-auto-animate>
                    <VeeField
                    v-model="form.last_name"
                    name="last_name"
                    type="text"
                    :as="Input"
                    placeholder="Příjmení"
                    class="py-6 px-4"
                    autofocus
                    />
                    
                    <ErrorMessage name="last_name" class="mt-1 absolute text-destructive text-sm" />
                </div>
            </div>

            
            <div class="relative mb-8" v-auto-animate>
                <VeeField 
                v-model="form.email"
                name="email"
                type="email"
                :as="Input"
                placeholder="Email"
                class="py-6 px-4"
                />
                
                <ErrorMessage name="email" class="mt-1 absolute text-destructive text-sm" />
            </div>


            <div class="relative mb-8" v-auto-animate>
                <VeeField 
                v-model="form.username"
                name="username"
                type="text"
                :as="Input"
                placeholder="Username"
                class="py-6 px-4"
                autocomplete="off"
                />
                
                <ErrorMessage name="username" class="mt-1 absolute text-destructive text-sm" />
            </div>
        
            <div class="flex justify-between flex-col lg:flex-row">

                <div class="mb-8" v-auto-animate>
                    <div class="relative">
                        <VeeField 
                        v-model="form.password"
                        name="password"
                        :type="passwordshow ? 'text' : 'password'"
                        :as="Input"
                        placeholder="Heslo"
                        class="py-6 px-4"
                        />
                        
                        <button type="button"
                        @click="passwordshow = !passwordshow"
                        class="flex absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer fill-action transition hover:fill-action/90"
                        >
                        <box-icon
                        :name="passwordshow ? 'hide' : 'show'"
                        type="solid"
                        />
                    </button>
                </div>
                
                <ErrorMessage name="password" class="mt-1 text-destructive text-sm" />
            </div>
            
            <div class="mb-3" v-auto-animate>
                <div class="relative">
                    <VeeField 
                    v-model="form.password_confirmation"
                    name="password_confirmation"
                    :type="passwordshow ? 'text' : 'password'"
                    :as="Input"
                    placeholder="Znovu heslo"
                    class="py-6 px-4"
                    />
                    
                    <button type="button"
                    @click="passwordshow = !passwordshow"
                    class="flex absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer fill-action transition hover:fill-action/90"
                    >
                    <box-icon
                    :name="passwordshow ? 'hide' : 'show'"
                    type="solid"
                    />
                </button>
            </div>
            
            <ErrorMessage name="password_confirmation" class="mt-1 text-destructive text-sm" />
            </div>
        </div>
            
            
            <div class="flex items-center space-x-2" v-auto-animate>
                
                <VeeField name="tos" v-slot="{ field }">
                    <Checkbox
                        v-model:checked="form.tos"
                        id="tos"
                        class="border-action data-[state=checked]:bg-action data-[state=checked]:text-action-foreground"
                        @update:checked="field.onChange"
                        @blur="field.onBlur">
                    </Checkbox>
                </VeeField>
                
                <label for="tos" class="text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Souhlasím se Smluvními podmínky</Label>
                </div>
                <ErrorMessage name="tos" class="text-destructive text-sm" />
                
            <div class="mt-9 flex">
                <Button :disabled="form.processing" size="action" variant="action" type="submit" class="w-full max-w-44">
                    Vytvořit účet
                </Button>
                <Button variant="link" :as="Link"
                    :href="route('login')">
                    Už máš učet?<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                </Button>
            </div>
        </VeeForm>




















        <!-- <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form> -->
    </GuestLayout>
</template>
