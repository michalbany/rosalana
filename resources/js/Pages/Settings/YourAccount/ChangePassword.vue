<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import { Head } from "@inertiajs/vue3";
import SettingsSearch from "../SettingsSearch.vue";


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

        <SettingsSearch />

        <hr class="mt-5" />

        <div class="mt-5 mb-10">
            <UpdatePasswordForm class="max-w-xl" />
        </div>
    </AuthenticatedLayout>
</template>
