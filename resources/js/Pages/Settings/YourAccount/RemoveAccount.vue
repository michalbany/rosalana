<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import SettingsSearch from "../SettingsSearch.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
</script>
<template>
<Head title="Settings" />

<AuthenticatedLayout>
    <template #header> Remove account</template>

    <template #icon>
        <box-icon name="cog" type="solid" class="fill-white w-5" />
    </template>

    <template #description>
        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
        your account, please download any data or information that you wish to retain.
    </template>

    <SettingsSearch />

    <hr class="mt-5" />

    <div class="mt-5 mb-10">
        <DeleteUserForm class="max-w-xl"/>
    </div>
</AuthenticatedLayout>
</template>