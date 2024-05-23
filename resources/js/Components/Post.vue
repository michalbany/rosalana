<script setup>
import { Link } from "@inertiajs/vue3";
import UserThumb from "@/Components/UserThumb.vue";

defineProps({
    post: Object,
});
</script>
<template>
    <div class="bg-accent p-4 flex flex-col">
        <UserThumb :post="post" />

        {{ post.title }}
    </div>
</template>
