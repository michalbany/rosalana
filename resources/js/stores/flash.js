import { defineStore } from 'pinia';
import { ref } from 'vue';


export const useFlashStore = defineStore('flash', () => {
    
    const show = ref(false);
    const message = ref('');

    function showFlash(msg = '') {
        show.value = true;
        message.value = msg;
    }

    function hideFlash() {
        show.value = false;
        message.value = '';
    }

    return {
        show,
        message,
        showFlash,
        hideFlash,
    };
});