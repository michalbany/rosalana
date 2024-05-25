<script setup>
import { ref, computed } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { Avatar, AvatarFallback, AvatarImage } from "@/Components/ui/avatar";
import { Button } from "@/Components/ui/button";
import { Badge } from "@/Components/ui/badge";
import { useToast } from '@/Components/ui/toast/use-toast'
import { Toaster } from '@/Components/ui/toast'
import { watchEffect } from "vue";
import { useFlashStore } from '@/stores/flash';

const showingNavigationDropdown = ref(false);

const flashStore = useFlashStore();

const { toast } = useToast();



// @error: Pokud během zobrazení flash message dojde k navigaci na jinou stránku
// @explain: Flash message musí fungovat uplně mimo layout a nesmí se unmountout při redirectu.
watchEffect(() => {
    const flash = usePage().props.flash;

    if (!flashStore.show) {
        return;
    }

    if (flash.error) {
        toast({
            title: flash.error,
            description: flashStore.message,
        });
        flashStore.hideFlash();
    }
})

</script>

<template>
    <div
        class="min-h-screen bg-white selection:bg-action selection:text-accent"
    >
        <!-- Flash Message -->
        <Toaster />
   

        <!-- Navigace -->
        <nav class="w-full sticky top-0 bg-white sm:bg-transparent z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-24">
                    <Link href="/" showProgress="true">
                        <ApplicationLogo class="w-36 fill-primary" />
                    </Link>

                    <div class="gap-6 hidden sm:flex items-center">
                        <div class="space-x-3">
                            <Button
                                variant="ghost"
                                size="icon"
                                class="rounded-lg"
                            >
                                <box-icon
                                    name="search-alt-2"
                                    class="fill-black w-5"
                                />
                            </Button>

                            <Button
                                variant="ghost"
                                size="icon"
                                class="rounded-lg"
                            >
                                <box-icon
                                    name="bell"
                                    type="solid"
                                    class="fill-black w-5"
                                />
                            </Button>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <Avatar
                                        size="sm"
                                        class="text-sm w-12 h-12 cursor-pointer"
                                    >
                                        <AvatarImage
                                            :src="$page.props.auth.user.avatar"
                                            :alt="`${$page.props.auth.user.username}.profilephoto`"
                                        />
                                        <AvatarFallback
                                            >{{
                                                $page.props.auth.user.first_name[0].toUpperCase()
                                            }}{{
                                                $page.props.auth.user.last_name[0].toUpperCase()
                                            }}</AvatarFallback
                                        >
                                    </Avatar>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.show', {user: $page.props.auth.user})">
                                        Profile
                                    </DropdownLink>
                                    <DropdownLink :href="route('settings')">
                                        Settings
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="sm:hidden"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                    >
                        Feeds
                    </ResponsiveNavLink>

                    <ResponsiveNavLink
                        :href="route('profile.show', {user: $page.props.auth.user})"
                        :active="route().current('profile.show', {user: $page.props.auth.user})"
                    >
                    Profile
                    </ResponsiveNavLink>

                    <ResponsiveNavLink
                        :href="route('login')"
                        :active="route().current('login')"
                    >
                    Bookmarks
                    </ResponsiveNavLink>

                    <ResponsiveNavLink
                        :href="route('login')"
                        :active="route().current('login')"
                    >
                    Collections
                    </ResponsiveNavLink>
                    
                    <ResponsiveNavLink
                        :href="route('login')"
                        :active="route().current('login')"
                    >
                    Explore
                    </ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.props.auth.user.first_name }}
                            {{ $page.props.auth.user.last_name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">
                            {{ $page.props.auth.user.email }}
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.show', {user: $page.props.auth.user})">
                            Profile
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('settings')">
                            Settings
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('logout')"
                            method="post"
                            as="button"
                        >
                            Log Out
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <div
            class="relative max-w-7xl mx-auto py-6 px-4 sm:py-6 lg:px-8 grid grid-cols-1 sm:grid-cols-9 gap-6"
            
            >
            <nav class="sm:col-span-2 hidden sm:flex flex-col gap-4 sticky top-[7.5rem] h-fit" >
                <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                    icon="home"
                >
                    Feeds
                </NavLink>

                <NavLink
                    :href="route('profile.show', {user: $page.props.auth.user})"
                    :active="route().current('profile.show', {user: $page.props.auth.user})"
                    icon="user"
                >
                    Profile
                </NavLink>

                <NavLink
                    :href="route('login')"
                    :active="route().current('login')"
                    icon="bookmark"
                >
                    Bookmarks
                </NavLink>

                <NavLink
                    :href="route('login')"
                    :active="route().current('login')"
                    icon="folder"
                >
                    Collections
                </NavLink>

                <NavLink
                    :href="route('login')"
                    :active="route().current('login')"
                    icon="compass"
                >
                    Explore
                </NavLink>

                <hr class="mt-6 mb-3" />

                <Button variant="action" size="action">
                    Write a post
                    <box-icon
                        name="pen"
                        type="solid"
                        class="fill-white w-5 ml-1"
                    />
                </Button>
            </nav>

            <div class="sm:col-span-5">
                <!-- Page Heading -->
                <header v-if="$slots.header">
                    <div class="flex gap-3">
                        <Badge class="mt-2 shrink-0"
                            ><slot name="icon" /></Badge>
                        <h1 class="font-semibold text-5xl sm:text-6xl text-primary">
                            <slot name="header" />
                            <svg
                                class="inline-block ml-4"
                                xmlns="http://www.w3.org/2000/svg"
                                width="129"
                                height="33"
                                viewBox="0 0 129 33"
                            >
                                <g
                                    id="Group_105"
                                    data-name="Group 105"
                                    transform="translate(-793 -194)"
                                >
                                    <circle
                                        id="Ellipse_35"
                                        data-name="Ellipse 35"
                                        cx="16.5"
                                        cy="16.5"
                                        r="16.5"
                                        transform="translate(793 194)"
                                        fill="#ffc551"
                                    />
                                    <circle
                                        id="Ellipse_36"
                                        data-name="Ellipse 36"
                                        cx="16.5"
                                        cy="16.5"
                                        r="16.5"
                                        transform="translate(831 194)"
                                        fill="#ff8966"
                                    />
                                    <circle
                                        id="Ellipse_37"
                                        data-name="Ellipse 37"
                                        cx="16.5"
                                        cy="16.5"
                                        r="16.5"
                                        transform="translate(869 194)"
                                        fill="#ff5d75"
                                    />
                                    <circle
                                        id="Ellipse_38"
                                        data-name="Ellipse 38"
                                        cx="16.5"
                                        cy="16.5"
                                        r="16.5"
                                        transform="translate(889 194)"
                                        fill="#645bff"
                                    />
                                </g>
                            </svg>
                        </h1>
                    </div>

                    <p class="ml-14 mt-3 text-sm">
                        <slot name="description" />
                    </p>
                </header>

                <main class="mx-4">
                    <slot />
                </main>
            </div>

            <div class="hidden sm:block sm:col-span-2 sticky top-[7.5rem] h-fit">
                <!-- Title -->
                <div class="flex mb-6 gap-3 items-center">
                    <Badge>
                        <box-icon
                            type="solid"
                            name="user"
                            class="fill-white w-5 sm:w-7"
                        />
                    </Badge>

                    <div class="leading-5">
                        <h3 class="font-bold">More users</h3>
                        <p>Meet more people</p>
                    </div>
                </div>

                <!-- Users to follow -->
                <div class="space-y-4">
                <div class="flex gap-4 items-center">
                    <Avatar size="sm">
                        <AvatarImage
                            src="$page.props.auth.user.avatar"
                            :alt="`${$page.props.auth.user.username}.profilephoto`"
                        />
                        <AvatarFallback
                            >{{
                                $page.props.auth.user.first_name[0].toUpperCase()
                            }}{{
                                $page.props.auth.user.last_name[0].toUpperCase()
                            }}</AvatarFallback
                        >
                    </Avatar>

                    <div class="flex flex-col grow truncate">
                        <h4 class="hover:text-action font-semibold truncate">
                            first_name last_name
                        </h4>
                        <p class="text-sm">@username</p>
                    </div>
                    <Button size="icon" class="shrink-0">
                        <box-icon name="user-plus" class="fill-white" />
                    </Button>
                </div>

                <div class="flex gap-4 items-center">
                    <Avatar size="sm">
                        <AvatarImage
                            src="$page.props.auth.user.avatar"
                            :alt="`${$page.props.auth.user.username}.profilephoto`"
                        />
                        <AvatarFallback
                            >{{
                                $page.props.auth.user.first_name[0].toUpperCase()
                            }}{{
                                $page.props.auth.user.last_name[0].toUpperCase()
                            }}</AvatarFallback
                        >
                    </Avatar>

                    <div class="flex flex-col grow truncate">
                        <h4 class="hover:text-action font-semibold truncate">
                            first_name last_name
                        </h4>
                        <p class="text-sm">@username</p>
                    </div>
                    <Button size="icon" class="shrink-0">
                        <box-icon name="user-plus" class="fill-white" />
                    </Button>
                </div>
                
                <div class="flex gap-4 items-center">
                    <Avatar size="sm">
                        <AvatarImage
                            src="$page.props.auth.user.avatar"
                            :alt="`${$page.props.auth.user.username}.profilephoto`"
                        />
                        <AvatarFallback
                            >{{
                                $page.props.auth.user.first_name[0].toUpperCase()
                            }}{{
                                $page.props.auth.user.last_name[0].toUpperCase()
                            }}</AvatarFallback
                        >
                    </Avatar>

                    <div class="flex flex-col grow truncate">
                        <h4 class="hover:text-action font-semibold truncate">
                            first_name last_name
                        </h4>
                        <p class="text-sm">@username</p>
                    </div>
                    <Button size="icon" class="shrink-0">
                        <box-icon name="user-plus" class="fill-white" />
                    </Button>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>