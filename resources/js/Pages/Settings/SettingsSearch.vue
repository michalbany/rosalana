<script setup>
import { Input } from "@/Components/ui/input";
import { Link, router } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { settingsSearchData } from "@/data/settingsSearchData";

const searchQuery = ref("");
const activeIndex = ref(-1);

const filterData = computed(() => {
    if (!searchQuery.value) {
        activeIndex.value = -1;
        return [];
    }

    let data = settingsSearchData.filter((item) => {
        return (
            item.title
                .toLowerCase()
                .includes(searchQuery.value.toLowerCase()) ||
            item.searchTags.some((tag) =>
                tag.toLowerCase().includes(searchQuery.value.toLowerCase())
            ) ||
            item.section.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
    });
    activeIndex.value = -1;
    return data.slice(0, 5);
});

const onKeyDown = (event) => {
    if (event.key === "ArrowDown") {
        event.preventDefault();

        if (activeIndex.value < filterData.value.length - 1) {
            activeIndex.value++;
        } else {
            activeIndex.value = 0;
        }

    } else if (event.key === "ArrowUp") {
        event.preventDefault();
        if (activeIndex.value > 0) {
            activeIndex.value--;
        } else {
            activeIndex.value = filterData.value.length - 1;
        }

    } else if (event.key === "Enter" && activeIndex.value !== -1) {
        event.preventDefault();
        selectActiveItem();
    }
};

const selectActiveItem = () => {
    if (activeIndex.value >= 0) {
        const item = filterData.value[activeIndex.value];
        if (item) {
            router.visit(route(item.link));
        }
    }
};

const addEListeners = () => {
    window.addEventListener("keydown", onKeyDown);
};

const removeEListeners = () => {
    window.removeEventListener("keydown", onKeyDown);
};

</script>
<template>
    <div class="mt-8 relative items-center relative">
        <Input
            type="text"
            @focus="addEListeners"
            @blur="removeEListeners"
            placeholder="Search in Settings..."
            v-model="searchQuery"
            class="pl-10 bg-transparent hover:bg-accent focus:bg-accent py-5"
            :class="{ 'rounded-b-none bg-accent': filterData.length }"
        />
        <box-icon
            name="search"
            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5"
        />

        <div
            v-auto-animate
            class="absolute bg-accent rounded-b-md z-20 w-full"
        >
            <Link
                class="block hover:text-action last-of-type:rounded-b-md transition-color py-3 px-10 duration-200 ease-in-out"
                v-for="(item, index) in filterData"
                :key="item.title"
                :href="route(item.link)"
                :class="{ 'text-action bg-action/20': index === activeIndex }"
            >   
                <h3 class="text-md font-medium flex justify-between items-center">{{ item.title }} <span v-if="index === activeIndex" class="text-xs font-normal text-zinc-500 hidden sm:block">Settings/{{ item.section }}</span></h3>
                <p class="text-zinc-600 text-sm">{{ item.description }}</p>
            </Link>
        </div>
    </div>
</template>
