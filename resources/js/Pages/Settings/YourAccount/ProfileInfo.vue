<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";
import { Input } from "@/Components/ui/input";

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
            <UpdateProfileInformationForm
                :must-verify-email="mustVerifyEmail"
                :status="status"
                class="max-w-xl"
            />
        </div>
    </AuthenticatedLayout>
</template>
