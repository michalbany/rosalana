<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import { Badge } from "@/Components/ui/badge";
import WelcomeImage from "../../images/static/welcome.png";
</script>

<template>
    <div
        class="min-h-screen flex flex-col bg-white selection:bg-action selection:text-accent"
    >
        <!-- Navigace -->
        <nav class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                <Link href="/">
                    <ApplicationLogo class="w-36 fill-primary" />
                </Link>
                <slot name="nav-button" />
            </div>
        </nav>

        <!-- Main -->
        <div
            class="max-w-7xl mx-auto py-6 px-4 mt-3 sm:mt-10 sm:px-6 lg:px-8 gap-12 grid grid-cols-1 place-items-center md:grid-cols-2 md:place-items-stretch lg:grid-cols-2 lg:place-items-stretch"
        >
            <!-- Obsah -->
            <div>
                <!-- Badge -->
                <div class="flex gap-3 items-center">
                    <Badge>
                        <box-icon
                            type="solid"
                            name="star"
                            class="fill-white w-5 sm:w-7"
                        />
                    </Badge>

                    <div class="leading-5">
                        <h3 class="font-bold">Probuď svoji kreativitu</h3>
                        <p>Začni nyní</p>
                    </div>
                </div>

                <h1 class="text-5xl sm:text-7xl font-medium my-7 sm:my-10">
                    <slot name="header" />
                </h1>
                <hr />

                <slot />
            </div>

            <!-- Image -->
            <div class="h-full rounded-xl hidden md:block lg:block overflow-hidden">
                <img
                    :src="WelcomeImage"
                    alt="Welcome image"
                    class="w-full h-full object-cover"
                />
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-primary py-4 mt-16 flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center mb-3">
                    
                    <p class="text-sm text-action mb-3 md:mb-0">Rosalana OPEN BETA 3.0</p>
                    <div class="flex md:gap-2 gap-1 flex-col md:flex-row">
                        <Button
                            variant="anchor"
                            :as="Link"
                            :href="route('dashboard')"
                            class="text-white flex gap-2 items-center"
                            >
                            <box-icon name="trip" class="w-5 fill-purple" />
                            O projektu
                        </Button>
                        <Button
                            variant="anchor"
                            :as="Link"
                            :href="route('dashboard')"
                            class="text-white flex gap-2 items-center"
                            >
                            <box-icon name="bug-alt" type="solid" class="w-5 fill-orange" />
                            Nahlásit problém
                        </Button>
                        <Button
                            variant="anchor"
                            :as="Link"
                            :href="route('dashboard')"
                            class="text-white flex gap-2 items-center"
                            >
                            <box-icon name="trip" class="w-5 fill-destructive" />
                            O projektu
                        </Button>
                    </div>
                    
                </div>
                <hr class="border-gray-800"/>


                <div class="text-center text-sm text-gray-500 mt-8">
                    <p>
                        &copy; Rosalana 2023 - {{ new Date().getFullYear() }}. Všechna
                        práva vyhrazena.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
