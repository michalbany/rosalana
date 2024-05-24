<script setup>
import Post from "@/Components/Post.vue";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import { onMounted } from "vue";
import PostAlt from "@/Components/PostAlt.vue";
import { ref } from "vue";

const feed = ref([]);

onMounted(() => {
    router.reload({
        only: ["feed", "offset"],
        headers: {
            "offset": 0,
        },
        onSuccess: (page) => {
            feed.value = page.props.feed;
        },
        onError: (error) => console.log(error),
    });
});

const loadMorePosts = () => {

    router.reload({
        only: ["feed", "offset", "flash"],
        headers: {
            "offset": usePage().props.offset,
        },
        onSuccess: (page) => {
            feed.value.push(...page.props.feed);
        },
        onError: (error) => console.log(error),
    });
}

</script>
<template>
    <button @click="loadMorePosts">Click to load more</button>
    <div class="mt-5" >
        <div v-if="feed.length" class="space-y-5" >
            <Post v-for="post in feed" :key="post.id" :post="post" />
        </div>

        <div v-else class="space-y-5">
            <PostAlt />
            <PostAlt />
            <PostAlt />
        </div>

    </div>
</template>
