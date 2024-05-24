<script setup>
import Post from "@/Components/Post.vue";
import { usePage } from "@inertiajs/vue3";

const { feed } = usePage().props;

</script>
<template>
    <div class="space-y-5 mt-5">
        <Post v-for="post in feed" :key="post.id" :post="post" />
    </div>
</template>
