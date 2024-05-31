<script setup>
import { Link } from "@inertiajs/vue3";
import UserThumb from "@/Components/UserThumb.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import DropdownCall from "@/Components/DropdownCall.vue";
import { Button } from "@/Components/ui/button";
import { formatNumber } from "@/includes/helpers";

defineProps({
    post: Object,
});
</script>
<template>
    <div class="bg-accent p-5 flex flex-col rounded-md">
        <div class="flex items-start justify-between">
            <UserThumb :post="post" />
            <div class="relative">
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <Button class="p-0" variant="icon">
                            <box-icon name='dots-horizontal-rounded' />
                        </Button>
                    </template>

                    <template #content>
                        <DropdownCall @dropdown-click="console.log('clicked')">
                            Edit
                        </DropdownCall>
                    </template>
                </Dropdown>
            </div>
        </div>

        <a href="/settings" class="block">
            <p>{{ post.id }}</p>
            <h2 class="text-lg font-semibold truncate">{{ post.title }}</h2>
            <p class="text-sm text-gray-500">{{ post.description }}</p>
        </a>

        <div class="flex items-center justify-between mt-5">
            <div class="space-x-3">
                <Button variant="icon" class="p-0">
                    <box-icon name='heart' type="solid" class="w-5 fill-destructive" />
                    {{ formatNumber(13000000000) }}
                </Button>
                <Button variant="icon" class="p-0">
                    <box-icon name='show' type="solid" class="w-5 fill-green" />
                    55
                </Button>
                <Button variant="icon" class="p-0">
                    <box-icon name='message-rounded' type="solid" class="w-5 fill-orange" />
                    13
                </Button>
            </div>

            <div>
                
            </div>
        </div>
    </div>
</template>