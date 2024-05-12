<script setup>
import InputError from "@/Components/InputError.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { Avatar, AvatarFallback, AvatarImage } from "@/Components/ui/avatar";
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";
import { computed, ref } from "vue";
import { CircleStencil, Cropper } from "vue-advanced-cropper";
import Modal from '@/Components/Modal.vue';
import 'vue-advanced-cropper/dist/style.css'
import 'vue-advanced-cropper/dist/theme.bubble.css';
import WelcomeImage from "../../../../../images/static/welcome.png";

const cropper = ref(null);
const fileInput = ref(null);


const selectedImageURL = ref(null);  // Ukládá lokální url obrázku
const selectedImage = ref(null);  // Ukládá vybraný obrázek
const croppedImage = ref(null); // Ukládá nový obrázek


// Potřebujeme více dat lokální url na obrázek, samotný obrázek + nový obrázek


// Odesíláme 2 obrázky, jeden originální a druhý oříznutý
const form = useForm({
    avatar: null,
    avatar_original: null,
});

const uploadModal = ref(false);

const openUploadModal = () => {
    uploadModal.value = true;
};

const closeUploadModal = () => {
    uploadModal.value = false;
    fileInput.value.value = null;
    URL.revokeObjectURL(selectedImageURL.value);
}

// Cropper fn
const flip = (x, y) => {
    cropper.value.flip(x, y);
}

const rotate = (angle) => {
    cropper.value.rotate(angle);
}

const editImage = () => {
    // Upravime cesty v cropperu na cesty z už uložených obrázku
}

const selectImage = () => {
    fileInput.value.click();
}

const onFileChange = (e) => {
    const file = e.target.files[0];
    
    if (file) {
        selectedImage.value = file;
        selectedImageURL.value = URL.createObjectURL(file);
    }
    openUploadModal();

}

</script>
<template>
    <h3 class="pt-5 pb-2 font-medium">Profile image</h3>

    <div class="flex pl-10 gap-5">
        <Avatar size="lg">
            <AvatarImage src="$page.props.auth.user.avatar" :alt="`${$page.props.auth.user.username}.profilephoto`" />
            <AvatarFallback>{{ $page.props.auth.user.first_name[0].toUpperCase()
                }}{{
                $page.props.auth.user.last_name[0].toUpperCase()
            }}</AvatarFallback>
        </Avatar>

        <div class="flex flex-col gap-2 justify-center">
            <Button v-if="$page.props.auth.user.avatar" type="button" variant="secondary"
                @click="openUploadModal">Edit</Button>

            <Button type="button" variant="outline" @click="selectImage">Upload</Button>

            <Button type="button" variant="destructive">Remove</Button>
            <input type="file" ref="fileInput" accept="image/*" @change="onFileChange($event)" class="hidden" />
        </div>
    </div>

    <Modal :show="uploadModal" @close="closeUploadModal">
        <div class="p-6">
            <div class="relative">
                <div class="absolute top-1/2 -translate-y-1/2 left-5 z-50 flex flex-col gap-3">
                    <Button type="button" size="icon" variant="secondary" @click="flip(true)"><box-icon
                            name="reflect-vertical" /></Button>
                    <Button type="button" size="icon" variant="secondary" @click="flip(false, true)"><box-icon
                            name="reflect-horizontal" /></Button>
                    <Button type="button" size="icon" variant="secondary" @click="rotate(90)"><box-icon
                            name="rotate-left" /></Button>
                    <Button type="button" size="icon" variant="secondary" @click="rotate(-90)"><box-icon
                            name="rotate-right" /></Button>
                </div>

                <Cropper ref="cropper" :src="selectedImageURL" class="cropper" :stencil-component="CircleStencil"
                    :default-size="{
                        width: 400,
                        height: 400
                    }" 
                    :auto-zoom="true"
                />
            </div>
            <div class="mt-6 space-x-2">
                <Button type="button" variant="secondary" @click="closeUploadModal">Cancel</Button>
                <Button type="button" variant="action">Upload</Button>
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
                </progress>
            </div>
        </div>

    </Modal>
</template>

<style scoped>
.cropper {
    height: 400px;
}
</style>