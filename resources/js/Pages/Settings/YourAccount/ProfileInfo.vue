<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import UploadAvatar from "./Partials/UploadAvatar.vue";
import { Head } from "@inertiajs/vue3";
import SettingsSearch from "../SettingsSearch.vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <template #header> Profile information </template>

        <template #icon>
            <box-icon name="cog" type="solid" class="fill-white w-5" />
        </template>

        <template #description>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
            vulputate tristique lacus, id pretium lorem luctus non. Etiam sit
            amet elit massa. Duis eu finibus orci, id luctus quam. Nullam nec
            nunc nec nunc ultricies ultricies.
        </template>

        <SettingsSearch />

        <hr class="mt-5" />

        <div class="mt-5 mb-10">
            <UploadAvatar />

            <UpdateProfileInformationForm
                :must-verify-email="mustVerifyEmail"
                :status="status"
                class="max-w-xl"
            />
        </div>
    </AuthenticatedLayout>
</template>
