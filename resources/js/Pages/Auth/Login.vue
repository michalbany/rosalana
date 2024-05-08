<script setup>
import { computed, ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Checkbox } from '@/Components/ui/checkbox';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const schema = computed(() => ({
    email: 'required|email',
    password: 'required|min:6',
}));

const passwordshow = ref(false);


const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Přihlášení" />

        <template #header>
            Přihlásit
        </template>

        <template #nav-button>
            <Button
            :as="Link"
            :href="route('register')"
            size="action"
            variant="action"
            class="hidden lg:inline-flex md:inline-flex">
                <p>Registrovat<span class="font-normal"> - Zdarma</span></p>
            </Button>

            <Button
            :as="Link"
            :href="route('register')"
            size="action"
            variant="action"
            class="inline-flex lg:hidden md:hidden">
                <p>Registrovat</p>
            </Button>

        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <VeeForm 
            @submit="submit" 
            :validation-schema="schema"
            class="mt-8 sm:mt-10 max-w-md"
            >
            
            <InputError class="my-2" :message="form.errors.email" />
            <div class="relative mb-8" v-auto-animate>
                <VeeField 
                v-model="form.email"
                name="email"
                type="email"
                :as="Input"
                placeholder="Email"
                class="py-6 px-4"
                autofocus
                autocomplete="username"
                />

                <ErrorMessage name="email" class="mt-1 absolute text-destructive text-sm" />
            </div>
        
            <div class="mb-3" v-auto-animate>
                <div class="relative">
                    <VeeField 
                    v-model="form.password"
                    name="password"
                    :type="passwordshow ? 'text' : 'password'"
                    :as="Input"
                    placeholder="Heslo"
                    class="py-6 px-4"
                    />
                    
                    <button type="button" tabindex="-1"
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


            <div class="flex items-center space-x-2">
                <Checkbox id="remember" v-model:checked="form.remember" class="border-action data-[state=checked]:bg-action data-[state=checked]:text-action-foreground"/>
                <label for="remember" class="text-sm leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Pamatuj si mě</Label>
            </div>

            <div class="mt-9 flex">
                <Button :disabled="form.processing" size="action" variant="action" type="submit" class="w-full max-w-44">
                    Přihlásit se
                </Button>
                <Button variant="link" :as="Link"
                    v-if="canResetPassword"
                    :href="route('password.request')">
                    Zapomenuté heslo?<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                </Button>
            </div>
        </VeeForm>
    </GuestLayout>
</template>
