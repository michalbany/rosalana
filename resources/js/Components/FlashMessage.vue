<script setup>
import { watchEffect } from 'vue';
import { useFlashStore } from '@/stores/flash';
import { useToast } from '@/Components/ui/toast/use-toast'
import { Toaster } from '@/Components/ui/toast'
import { usePage } from '@inertiajs/vue3';

/**
 * @note: Pro tento komponent jsem vytvořil vlastní app
 *        která běží zároveň s hlavní aplikací. Tím se
 *        mi komponent stane globálním a neunmountuje se
 *        se změnou stránky.
 * 
 * @changed: [app.js, app.blade.php]
 * 
 * Sleduj jestli s tím nenastane error jidne!
 */


const flashStore = useFlashStore();

const { toast } = useToast();

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
    <Toaster />
</template>