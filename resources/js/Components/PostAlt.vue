<script setup>
import { Button } from "@/Components/ui/button";

</script>
<template>
    <div class="bg-accent animate-pulse p-5 flex flex-col rounded-md">
        <div class="flex items-start justify-between">
            <!-- <UserThumb :post="post" /> -->
            <div class="select-none rounded-full w-10 h-10 shrink-0 bg-muted-foreground/40"></div>

            <div>
                <box-icon name="dots-horizontal-rounded" class="fill-muted-foreground/40" />
            </div>
            
        </div>

        <div class="mt-4 space-y-3">
            <div class="w-64 h-6 bg-muted-foreground/30 rounded"></div>
            <p class="h-14 bg-muted-foreground/10 rounded"></p>
        </div>

        <div class="flex items-center justify-between mt-5">
            <div class="space-x-3">
                <Button variant="icon" class="p-0 text-muted-foreground/40">
                    <box-icon name='heart' type="solid" class="w-5 fill-muted-foreground/40" />
                    0
                </Button>
                <Button variant="icon" class="p-0 text-muted-foreground/40">
                    <box-icon name='show' type="solid" class="w-5 fill-muted-foreground/40" />
                    0
                </Button>
                <Button variant="icon" class="p-0 text-muted-foreground/40">
                    <box-icon name='message-rounded' type="solid" class="w-5 fill-muted-foreground/40" />
                    0
                </Button>
            </div>

            <div>
                
            </div>
        </div>
    </div>
</template>