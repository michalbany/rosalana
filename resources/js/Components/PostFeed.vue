<script setup>
import Post from "@/Components/Post.vue";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import { onMounted } from "vue";
import PostAlt from "@/Components/PostAlt.vue";
import { ref } from "vue";
import { watchEffect } from "vue";

const feed = ref(null);
const showSkeleton = ref(true);

const props = defineProps({
    trigger: Boolean,
});

const emit = defineEmits(["loaded"]);

watchEffect(() => {
    if (props.trigger) {
        loadMorePosts();
    }
});

const throttle = (func, wait = 3000) => {
    let timeout = null;
    return (...args) => {
        if (!timeout) {
            timeout = setTimeout(() => {
                timeout = null;
            }, wait);
            func(...args);
        }
    };
};


onMounted(() => {
    router.reload({
        only: ["feed", "offset"],
        headers: {
            "offset": 0,
        },
        onSuccess: (page) => {
            feed.value = page.props.feed;
            showSkeleton.value = false;
        },
        onError: (error) => console.log(error),
    });
});


const loadMorePosts = throttle(() => {
    router.reload({
        only: ["feed", "offset", "flash"],
        headers: {
            "offset": usePage().props.offset,
        },
        onBefore: () => {
            showSkeleton.value = true;
            emit("loaded");
        },
        onSuccess: (page) => {
            feed.value.push(...page.props.feed);
            showSkeleton.value = false;
        },

        onError: (error) => console.log(error),
    });
});

</script>
<template>
    <button @click="loadTest">CLICK TO TEST</button>
    <div class="mt-5" >
        <div class="space-y-5" >
            <Post v-for="post in feed" :key="post.id" :post="post" />
        </div>
    </div>
    
    <div v-if="showSkeleton" class="mt-5 space-y-5">
        <PostAlt />
        <PostAlt />
        <PostAlt />
        <PostAlt />
        <PostAlt />
    </div>
</template>
