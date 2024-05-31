<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { Avatar, AvatarFallback, AvatarImage } from "@/Components/ui/avatar";
import { Button } from "@/Components/ui/button";
import PostFeed from "@/Components/PostFeed.vue";
import { ref } from "vue";
import { onMounted } from "vue";
import { onUnmounted } from "vue";

const loadMoreTrigger = ref(false)
const canLoadMore = ref(false)

const props = defineProps({
    user: Object,
    isOwnProfile: Boolean,
});

const loadMore = () => {
    if (canLoadMore.value) {
        loadMoreTrigger.value = !loadMoreTrigger.value
        canLoadMore.value = false
    }
}

const handleScroll = () => {
    const buttomOfWindow = window.innerHeight + window.scrollY >= document.documentElement.offsetHeight - 50;
    if (buttomOfWindow) {
        canLoadMore.value = true
        loadMore()
    }
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})

</script>

<template>
    <Head :title="`${user.first_name} ${user.last_name}`" />

    
    <AuthenticatedLayout>
        <template #header> {{ user.first_name }} {{ user.last_name }} </template>
        
        <template #icon>
            <box-icon name="user" type="solid" class="fill-white w-5" />
        </template>
        
        <template #description>
            {{ user.bio }}
        </template>

        <div class="mt-8 w-full bg-zinc-200 flex items-end justify-between px-8 py-6 rounded-lg">
            <div v-if="isOwnProfile" class="flex items-center gap-3">
                <Button :as="Link" :href="route('settings.profile.edit')"><box-icon name="cog" type="solid" class="fill-white w-5"/>Manage</Button>
            </div>
            <div v-else class="flex items-center gap-3">
                <Button><box-icon name="user-plus" type="solid" class="fill-white w-5" />Follow</Button>
                <Button variant="action" ><box-icon name="star" type="solid" class="fill-white w-5" />Subscribe</Button>
            </div>
            <Avatar size="lg">
                <AvatarImage
                    :src="user.avatar"
                    :alt="`${user.username}.profilephoto`"
                />
                <AvatarFallback
                    >{{ user.first_name[0].toUpperCase()
                    }}{{
                        user.last_name[0].toUpperCase()
                    }}</AvatarFallback
                >
            </Avatar>
        </div>

        <PostFeed :trigger="loadMoreTrigger" @loaded="canLoadMore = false" />

        <!-- <p v-if="isOwnProfile">My profile</p>
        <p v-else>Not my profile</p> -->

    </AuthenticatedLayout>
</template>