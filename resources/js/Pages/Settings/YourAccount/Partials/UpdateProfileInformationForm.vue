<script setup>
import InputError from "@/Components/InputError.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { Avatar, AvatarFallback, AvatarImage } from "@/Components/ui/avatar";
import { Input } from "@/Components/ui/input";
import { Button } from "@/Components/ui/button";
import { Textarea } from "@/Components/ui/textarea";
import { computed } from "vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    first_name: user.first_name,
    last_name: user.last_name,
    email: user.email,
    bio: user.bio,
    username: user.username,
});

const schema = computed(() => ({
    name: "required|alphaSpaces",
    surname: "required|alphaSpaces",
    email: "required|email",
    username: "required|alphaDash",
    bio: "max:500",
}));

const submit = () => {
    form.patch(route("settings.profile.update"), {
        preserveScroll: true,
    });
};
</script>

<template>
    <VeeForm @submit="submit" :validation-schema="schema">
        <h3 class="pt-5 pb-2 font-medium">Profile image</h3>

        <div class="flex pl-10 gap-5">
            <Avatar size="lg">
                <AvatarImage
                    src="$page.props.auth.user.avatar"
                    :alt="`${$page.props.auth.user.username}.profilephoto`"
                />
                <AvatarFallback
                    >{{ $page.props.auth.user.first_name[0].toUpperCase()
                    }}{{
                        $page.props.auth.user.last_name[0].toUpperCase()
                    }}</AvatarFallback
                >
            </Avatar>

            <div class="flex flex-col gap-2">
                <Button type="button" variant="secondary">Edit</Button>
                <Button type="button" variant="outline">Upload</Button>
                <Button type="button" variant="destructive">Remove</Button>
            </div>
        </div>

        <h3 class="pt-5 pb-2 font-medium">Name and Surname</h3>
        <div class="flex justify-between gap-5 flex-col lg:flex-row">
            <div class="flex-1" v-auto-animate>
                <VeeField
                    v-model="form.first_name"
                    name="name"
                    type="text"
                    :as="Input"
                    placeholder="Name"
                    class="py-6 px-4"
                    :defaultValue="user.first_name"
                />

                <InputError class="my-2" :message="form.errors.first_name" />
                <ErrorMessage
                    name="name"
                    class="mt-1 text-destructive text-sm"
                />
            </div>
            <div class="flex-1" v-auto-animate>
                <VeeField
                    v-model="form.last_name"
                    name="surname"
                    type="text"
                    :as="Input"
                    placeholder="Surname"
                    class="py-6 px-4"
                    :defaultValue="user.last_name"
                />

                <InputError class="my-2" :message="form.errors.last_name" />
                <ErrorMessage
                    name="surname"
                    class="mt-1 text-destructive text-sm"
                />
            </div>
        </div>

        <h3 class="pt-5 pb-2 font-medium">Bio</h3>
        <div v-auto-animate>
            <VeeField
                v-model="form.bio"
                name="bio"
                type="text"
                :as="Textarea"
                placeholder="Write something about yourself..."
                class="p-4"
                :defaultValue="user.bio"
                rows="5"
            />

            <InputError class="my-2" :message="form.errors.bio" />
            <ErrorMessage name="bio" class="mt-1 text-destructive text-sm" />
        </div>
        <h3 class="pt-5 pb-2 font-medium">Email and Username</h3>
        <div class="flex justify-between gap-5 flex-col lg:flex-row">
            <div class="flex-1" v-auto-animate>
                <VeeField
                    v-model="form.email"
                    name="email"
                    type="email"
                    :as="Input"
                    placeholder="Email"
                    class="py-6 px-4"
                    :defaultValue="user.email"
                />

                <InputError class="my-2" :message="form.errors.email" />
                <ErrorMessage
                    name="email"
                    class="mt-1 text-destructive text-sm"
                />
            </div>
            <div class="flex-1" v-auto-animate>
                <VeeField
                    v-model="form.username"
                    name="username"
                    type="text"
                    :as="Input"
                    placeholder="Username"
                    class="py-6 px-4"
                    :defaultValue="user.username"
                />

                <InputError class="my-2" :message="form.errors.username" />
                <ErrorMessage
                    name="username"
                    class="mt-1 text-destructive text-sm"
                />
            </div>
        </div>

        <!-- @todo: Nutnost verifikovat účet není ještě implementovana -->
        <div v-if="mustVerifyEmail && user.email_verified_at === null">
            <p class="text-sm mt-2 text-gray-800">
                Your email address is unverified.
                <Link
                    :href="route('verification.send')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Click here to re-send the verification email.
                </Link>
            </p>

            <div
                v-show="status === 'verification-link-sent'"
                class="mt-2 font-medium text-sm text-green-600"
            >
                A new verification link has been sent to your email address.
            </div>
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
</template>
