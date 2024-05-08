<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Input } from "@/Components/ui/input";
import { Button } from "@/Components/ui/button";
import { useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";


const passwordshow = ref(false);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const schema = computed(() => ({
    "current password": "required",
    password: "required|min:4",
    "password confirmation": "passwordMismatch:@password",
}));

const updatePassword = () => {
    form.put(route("password.update"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <VeeForm @submit="updatePassword" :validation-schema="schema">
        <h3 class="pt-5 pb-2 font-medium">Update Password</h3>

        <div class="mb-3" v-auto-animate>
            <div class="relative">
                <VeeField
                    v-model="form.current_password"
                    name="current password"
                    :type="passwordshow ? 'text' : 'password'"
                    :as="Input"
                    placeholder="Current password"
                    class="py-6 px-4"
                />

                <button
                    tabindex="-1"
                    type="button"
                    @click="passwordshow = !passwordshow"
                    class="flex absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer fill-action transition hover:fill-action/90"
                >
                    <box-icon
                        :name="passwordshow ? 'hide' : 'show'"
                        type="solid"
                    />
                </button>
            </div>

            <InputError class="my-2" :message="form.errors.current_password" />
            <ErrorMessage
                name="current password"
                class="mt-1 text-destructive text-sm"
            />
        </div>
        <div class="mb-3" v-auto-animate>
            <div class="relative">
                <VeeField
                    v-model="form.password"
                    name="password"
                    :type="passwordshow ? 'text' : 'password'"
                    :as="Input"
                    placeholder="New password"
                    class="py-6 px-4"
                />

                <button
                    tabindex="-1"
                    type="button"
                    @click="passwordshow = !passwordshow"
                    class="flex absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer fill-action transition hover:fill-action/90"
                >
                    <box-icon
                        :name="passwordshow ? 'hide' : 'show'"
                        type="solid"
                    />
                </button>
            </div>

            <InputError class="my-2" :message="form.errors.password" />
            <ErrorMessage
                name="password"
                class="mt-1 text-destructive text-sm"
            />
        </div>
        <div class="mb-3" v-auto-animate>
            <div class="relative">
                <VeeField
                    v-model="form.password_confirmation"
                    name="password confirmation"
                    :type="passwordshow ? 'text' : 'password'"
                    :as="Input"
                    placeholder="Confirm password"
                    class="py-6 px-4"
                />

                <button
                    tabindex="-1"
                    type="button"
                    @click="passwordshow = !passwordshow"
                    class="flex absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer fill-action transition hover:fill-action/90"
                >
                    <box-icon
                        :name="passwordshow ? 'hide' : 'show'"
                        type="solid"
                    />
                </button>
            </div>

            <InputError class="my-2" :message="form.errors.password_confirmation" />
            <ErrorMessage
                name="password confirmation"
                class="mt-1 text-destructive text-sm"
            />
        </div>

        <div class="mt-4 flex items-center gap-4" v-auto-animate>
            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                Saved.
            </p>
            <Button
                type="submit"
                variant="action"
                size="action"
                :disabled="form.processing"
                >Save</Button
            >
        </div>
    </VeeForm>

    <!-- <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Update Password</h2>

            <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div>
                <InputLabel for="current_password" value="Current Password" />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="current-password"
                />

                <InputError :message="form.errors.current_password" class="mt-2" />
            </div>

            <div>
                <InputLabel for="password" value="New Password" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div>
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section> -->
</template>
