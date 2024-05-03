<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { Avatar, AvatarFallback, AvatarImage } from '@/Components/ui/avatar';
import { Button } from '@/Components/ui/button';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="min-h-screen bg-white selection:bg-action selection:text-accent">

        <!-- Navigace -->
        <nav class="w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex justify-between items-center h-24">
                    <Link href="/">
                    <ApplicationLogo class="w-36 fill-primary" />
                    </Link>

                    <div class="gap-6 hidden sm:flex items-center">
                        <div class="space-x-3">

                            <Button variant="ghost" size="icon" class="rounded-lg">
                                <box-icon name="search-alt-2" class="fill-black w-5" />
                            </Button>

                            <Button variant="ghost" size="icon" class="rounded-lg">
                                <box-icon name="bell" type="solid" class="fill-black w-5" />
                            </Button>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <Avatar size="sm" class="text-sm w-12 h-12 cursor-pointer">
                                        <AvatarImage src="$page.props.auth.user.avatar"
                                            :alt="`${$page.props.auth.user.username}.profilephoto`" />
                                        <AvatarFallback>{{ $page.props.auth.user.first_name[0].toUpperCase() }}{{
                                                $page.props.auth.user.last_name[0].toUpperCase() }}</AvatarFallback>
                                    </Avatar>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>


                    <!-- Hamburger -->
                    <div class="flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{
                                                hidden: showingNavigationDropdown,
                                                'inline-flex': !showingNavigationDropdown,
                                            }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{
                                                hidden: !showingNavigationDropdown,
                                                'inline-flex': showingNavigationDropdown,
                                            }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.props.auth.user.first_name }}
                            {{ $page.props.auth.user.last_name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:py-6 lg:px-8 grid grid-cols-9 gap-4">

            <nav class="col-span-2 flex flex-col gap-4">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" icon="home">
                    Hlavní strana
                </NavLink>

                <NavLink :href="route('profile.edit')" :active="route().current('profile.edit')" icon="user">
                    Profile
                </NavLink>

                <NavLink :href="route('login')" :active="route().current('login')" icon="bookmark">
                    Záložky
                </NavLink>

                <NavLink :href="route('login')" :active="route().current('login')" icon="folder">
                    Sbírky
                </NavLink>

                <NavLink :href="route('login')" :active="route().current('login')" icon="compass">
                    Objevuj
                </NavLink>

                <hr class="mt-6 mb-3" />

                <Button variant="action" size="action">
                    Nový příspěvek
                    <box-icon name="pen" type="solid" class="fill-white w-5 ml-1" />
                </Button>


            </nav>

            <div class="col-span-5">
                <!-- Page Heading -->
                <header class="bg-white shadow" v-if="$slots.header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>

                <main>
                    <slot />
                </main>
            </div>

            <div class="col-span-2">
                content

            </div>

        </div>


    </div>


</template>
