<script setup>
import {
    HoverCard,
    HoverCardTrigger,
    HoverCardContent,
} from "@/Components/ui/hover-card";
import { Avatar, AvatarFallback, AvatarImage } from "@/Components/ui/avatar";
import { Link } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import { formatMonthYear } from "@/includes/helpers";

import { ref } from "vue";

const isOpen = ref(false);
let hoverTimeout;

defineProps({
    post: Object,
});

const handleMouseEnter = () => {
    hoverTimeout = setTimeout(() => {
        isOpen.value = true;
    }, 700);
};

const handleMouseLeave = () => {
    clearTimeout(hoverTimeout);
    isOpen.value = false;
};
</script>
<template>
    <HoverCard :open="isOpen">
        <div class="mb-3">
            <HoverCardTrigger
                class="flex items-center w-fit gap-2"
                @mouseenter="handleMouseEnter"
                @mouseleave="handleMouseLeave"
            >
                <Avatar size="sm">
                    <AvatarImage
                        :src="post.user.avatar"
                        :alt="`${post.user.username}.profilephoto`"
                    >
                    </AvatarImage>
                    <AvatarFallback>
                        {{ post.user.first_name[0].toUpperCase()
                        }}{{ post.user.last_name[0].toUpperCase() }}
                    </AvatarFallback>
                </Avatar>

                <div>
                    <Button
                        :as="Link"
                        variant="anchor"
                        :href="
                            route('profile.show', {
                                user: post.user,
                            })
                        "
                        class="block text-sm font-medium p-0 h-auto"
                        >{{ post.user.first_name }}
                        {{ post.user.last_name }}</Button
                    >
                    <span class="block text-xs text-muted-foreground"
                        >@{{ post.user.username }}</span
                    >
                </div>
            </HoverCardTrigger>
        </div>

        <HoverCardContent :side="'right'">
            <div class="flex gap-4 items-center">
                <Avatar>
                    <AvatarImage
                        :src="post.user.avatar"
                        :alt="`${post.user.username}.profilephoto`"
                    />
                    <AvatarFallback
                        >{{ post.user.first_name[0].toUpperCase()
                        }}{{
                            post.user.last_name[0].toUpperCase()
                        }}</AvatarFallback
                    >
                </Avatar>
                <div>
                    <h4 class="text-sm font-semibold">
                        {{ post.user.first_name }}
                        {{ post.user.last_name }}
                    </h4>
                    <div class="flex items-center">
                        <box-icon
                            name="star"
                            type="solid"
                            class="fill-muted-foreground w-4 mr-1"
                        />
                        <span class="text-xs text-muted-foreground">
                            Rank {{ post.user.rank_points }}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <box-icon
                            name="calendar"
                            type="solid"
                            class="fill-muted-foreground w-4 mr-1"
                        />
                        <span class="text-xs text-muted-foreground">
                            Joined {{ formatMonthYear(post.user.created_at) }}
                        </span>
                    </div>
                </div>
            </div>
        </HoverCardContent>
    </HoverCard>
</template>
