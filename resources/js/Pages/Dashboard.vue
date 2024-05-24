<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import PostFeed from "@/Components/PostFeed.vue";
import { ref, onMounted, onUnmounted } from "vue";

const loadMoreTrigger = ref(false);
const canLoadMore = ref(false);

const loadMore = () => {
    if (canLoadMore.value) {
        loadMoreTrigger.value = !loadMoreTrigger.value;
        canLoadMore.value = false;
    }
}

const handleScroll = () => {
    const buttomOfWindow = window.innerHeight + window.scrollY >= document.documentElement.offsetHeight - 50;
    if (buttomOfWindow) {
        canLoadMore.value = true;
        loadMore();
    }
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});
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

        <h2>FILTER</h2>

        <hr class="mt-5" />

        <PostFeed :trigger="loadMoreTrigger" @loaded="canLoadMore = false" />

    </AuthenticatedLayout>
</template>
