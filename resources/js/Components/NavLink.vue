<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    icon: {
        type: String,
    },
});

const classes = computed(() =>
    props.active
        ? 'py-3.5'
        : 'py-2'
);
</script>

<template>
    <Button :variant="props.active ? 'default' : 'ghost'" size="nav" :class="classes" :as="Link" :href="href">
        <box-icon :name="props.icon" type="solid" :class="props.active ? 'fill-white' : 'fill-black'" />
        <slot />
    </Button>
</template>
