<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Input } from "@/Components/ui/input";
import { Button } from "@/Components/ui/button";
import { Link } from "@inertiajs/vue3";

</script>

<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <template #header> Settings </template>

        <template #icon>
            <box-icon name="cog" type="solid" class="fill-white w-5" />
        </template>

        <template #description>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
            vulputate tristique lacus, id pretium lorem luctus non. Etiam sit
            amet elit massa. Duis eu finibus orci, id luctus quam. Nullam nec
            nunc nec nunc ultricies ultricies.
        </template>

 
        <div class="mt-8 relative items-center">
            <Input type="text" placeholder="Search in Settings..." class="pl-10 bg-transparent hover:bg-accent focus:bg-accent py-5" />
            <box-icon name="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5" />
        </div>

        <hr class="mt-5">
        <!-- List of settings -->
        <div class="mb-10">
            <h3 class="pt-5 pb-2 font-medium">Your account</h3>
            <!-- Section List -->
                <div class="pl-10 space-y-3">
                    <!-- Section Item -->
                    <div class="flex items-center gap-4">
                        <box-icon name="user" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Profile information<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Update your profile information</p>
                        </div>    
                    </div>

                    <div class="flex items-center gap-4">
                        <box-icon name="credit-card" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Monetizations and plans<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Aut mollitia ut velit. Esse rem ut laboriosam sunt dolores. Assumenda odit </p>
                        </div>    
                    </div>

                    <div class="flex items-center gap-4">
                        <box-icon name="key" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Password change<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Aut mollitia ut velit. Esse rem ut laboriosam sunt dolores. Assumenda odit </p>
                        </div>    
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <box-icon name="trash-alt" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Remove account<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Update your profile information</p>
                        </div>    
                    </div>
                   
                </div>
            <h4 class="pt-5 pb-2 font-medium">Application</h4>
            <div class="pl-10 space-y-3">
                    <!-- Section Item -->
                    <div class="flex items-center gap-4">
                        <box-icon name="current-location" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Location and language<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Aut mollitia ut velit. Esse rem ut laboriosam sunt dolores. Assumenda odit </p>
                        </div>    
                    </div>

                    <div class="flex items-center gap-4">
                        <box-icon name="moon" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Display options<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Aut mollitia ut velit. Esse rem ut laboriosam sunt dolores. Assumenda odit </p>
                        </div>    
                    </div>

                    <div class="flex items-center gap-4">
                        <box-icon name="bell" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Notification and mails<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Aut mollitia ut velit. Esse rem ut laboriosam sunt dolores. Assumenda odit </p>
                        </div>    
                    </div>
                </div>
            <h4 class="pt-5 pb-2 font-medium">Privacy</h4>
            <div class="pl-10 space-y-3">
                    <!-- Section Item -->
                    <div class="flex items-center gap-4">
                        <box-icon name="fingerprint" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Sharing security<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Aut mollitia ut velit. Esse rem ut laboriosam sunt dolores. Assumenda odit </p>
                        </div>    
                    </div>

                    <div class="flex items-center gap-4">
                        <box-icon name="plug" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Connected apps<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Aut mollitia ut velit. Esse rem ut laboriosam sunt dolores. Assumenda odit </p>
                        </div>    
                    </div>

                    <div class="flex items-center gap-4">
                        <box-icon name="check-shield" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                GDPR and Terms and Conditions<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Aut mollitia ut velit. Esse rem ut laboriosam sunt dolores. Assumenda odit </p>
                        </div>    
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <box-icon name="ghost" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Blacklist<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Update your profile information</p>
                        </div>    
                    </div>
                   
                </div>
            <h4 class="pt-5 pb-2 font-medium">Support <span class="text-xs font-normal">odkaz na support.rosalana.co</span></h4>
            <div class="pl-10 space-y-3">
                    <!-- Section Item -->
                    <div class="flex items-center gap-4">
                        <box-icon name="flag" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Report a content<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Update your profile information</p>
                        </div>    
                    </div>

                    <div class="flex items-center gap-4">
                        <box-icon name="first-aid" type="solid" class="fill-primary w-8" />
                        <div>
                            <Button class="text-md font-medium p-0 h-auto" variant="anchor" :as="Link"
                                :href="route('password.request')">
                                Support<box-icon name='right-arrow-alt' class="-rotate-45" ></box-icon>
                            </Button>
                            <p class="text-zinc-600 text-sm">Aut mollitia ut velit. Esse rem ut laboriosam sunt dolores. Assumenda odit </p>
                        </div>    
                    </div>

                </div>
        </div>

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div> -->
    </AuthenticatedLayout>
</template>
