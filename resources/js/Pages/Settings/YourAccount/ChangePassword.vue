<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import { Head } from "@inertiajs/vue3";
import { Input } from "@/Components/ui/input";

</script>

<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <template #header> Password change </template>

        <template #icon>
            <box-icon name="cog" type="solid" class="fill-white w-5" />
        </template>

        <template #description>
            Ensure your account is using a long, random password to stay secure.
        </template>

        <div class="mt-8 relative items-center">
            <Input
                type="text"
                placeholder="Search in Settings..."
                class="pl-10 bg-transparent hover:bg-accent focus:bg-accent py-5"
            />
            <box-icon
                name="search"
                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5"
            />
        </div>

        <hr class="mt-5" />

        <div class="mt-5 mb-10">
            <UpdatePasswordForm class="max-w-xl" />
        </div>
    </AuthenticatedLayout>
</template>
