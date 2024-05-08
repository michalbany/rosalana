<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header> Feeds </template>

        <template #icon>
            <box-icon name="home" type="solid" class="fill-white w-5" />
        </template>

        <template #description>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
            vulputate tristique lacus, id pretium lorem luctus non. Etiam sit
            amet elit massa. Duis eu finibus orci, id luctus quam. Nullam nec
            nunc nec nunc ultricies ultricies.
        </template>

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div> -->
    </AuthenticatedLayout>
</template>
