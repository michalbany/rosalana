<script setup>
import InputError from "@/Components/InputError.vue";
import { Link, useForm, usePage, router } from "@inertiajs/vue3";
import { Avatar, AvatarFallback, AvatarImage } from "@/Components/ui/avatar";
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";
import { computed, ref } from "vue";
import { CircleStencil, Cropper } from "vue-advanced-cropper";
import Modal from '@/Components/Modal.vue';
import 'vue-advanced-cropper/dist/style.css'
import 'vue-advanced-cropper/dist/theme.bubble.css';

const cropper = ref(null);
const fileInput = ref(null);


const selectedImageURL = ref(null);  // Ukládá lokální url obrázku
const selectedImage = ref(null);  // Ukládá vybraný obrázek
const mimeType = ref('');

// Odesíláme 2 obrázky, jeden originální a druhý oříznutý
const form = useForm({
    avatar: null,
    avatar_original: null,
});

const uploadModal = ref(false);
const confirmDeleteModal = ref(false);

const openDeleteModal = () => {
    confirmDeleteModal.value = true;
}

const closeDeleteModal = () => {
    confirmDeleteModal.value = false;
}

const openUploadModal = (imageUrl) => {
    if (imageUrl) {
        selectedImageURL.value = imageUrl;
        let parts = imageUrl.split('.');
        mimeType.value = `image/${parts[parts.length - 1]}`;
    }

    uploadModal.value = true;
};

const closeUploadModal = () => {
    uploadModal.value = false;
    fileInput.value.value = null;
    selectedImage.value = null;
    selectedImageURL.value = null;
    URL.revokeObjectURL(selectedImageURL.value);
    form.errors.avatar_original = null;
}

// Cropper fn
const flip = (x, y) => {
    cropper.value.flip(x, y);
}

const rotate = (angle) => {
    cropper.value.rotate(angle);
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

const uploadAvatar = () => {
    const result = cropper.value.getResult();
    const MAX_SIZE = 2048;

    if (result && result.canvas) {
        const mime = selectedImage.value ? selectedImage.value.type : mimeType.value;
        const extention = mime.split('/')[1];

        result.canvas.toBlob((blob) => {
            const file = new File([blob], `avatar.${extention}`, { type: mime })
            form.avatar = file;
            if (selectedImage.value) {
                // MAX_SIZE exeption
                if (selectedImage.value.size > MAX_SIZE) {
                    form.errors.avatar_original = 'The image is too large. Max size is 2MB';
                    return;
                }
                form.avatar_original = selectedImage.value;
            }

            form.post(route('settings.avatar.upload'), {
                preserveScroll: true,
                onSuccess: () => {
                    closeUploadModal();
                    console.log('Upload successful');
                },
                onError: () => {
                    console.error('Upload failed');
                }
            });
        }, mime);
    }
};


const deleteAvatar = () => {
    router.delete(route('settings.avatar.delete'), {
        preserveScroll: true,
        onSuccess: () => {
            console.log('Delete successful');
            closeDeleteModal();
        },
    })
}

</script>
<template>
    <h3 class="pt-5 pb-2 font-medium">Profile image</h3>

    <div class="flex pl-10 gap-5">
        <Avatar size="lg">
            <AvatarImage :src="$page.props.auth.user.avatar" :alt="`${$page.props.auth.user.username}.avatar`" />
            <AvatarFallback>{{ $page.props.auth.user.first_name[0].toUpperCase()
                }}{{
                $page.props.auth.user.last_name[0].toUpperCase()
            }}</AvatarFallback>
        </Avatar>

        <!-- {{ $page.props.auth.user.avatar }} -->

        <div class="flex flex-col gap-2 justify-center">
            <Button v-if="$page.props.auth.user.avatar" type="button" variant="secondary"
                @click="openUploadModal($page.props.auth.user.avatar_original)">Edit</Button>

            <Button type="button" variant="outline" @click="selectImage">Upload</Button>

            <Button type="button" variant="destructive" @click="openDeleteModal">Remove</Button>
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
            }" :auto-zoom="true" />
            </div>
            <div class="mt-6 flex items-center gap-3">
                <Button type="button" variant="secondary" @click="closeUploadModal">Cancel</Button>

                <Button type="submit" :disable="form.processing" @click="uploadAvatar" variant="action">Upload</Button>
                <div v-if="form.progress" class="inline-flex">
                    <box-icon name='loader-alt' animation='spin' rotate='180' />
                    <p>{{ form.progress.percentage }}%</p>
                </div>
                <InputError :message="form.errors.avatar_original" />
            </div>
        </div>

    </Modal>


    <Modal :show="confirmDeleteModal" @close="closeDeleteModal">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete your avatar?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Once your avatar is deleted, its resources and data will be permanently deleted.
            </p>
            <div class="mt-6 flex items-center gap-3">
                <Button type="button" variant="secondary" @click="closeDeleteModal">Cancel</Button>

                <Button type="submit" @click="deleteAvatar" variant="destructive">Remove</Button>
            </div>
        </div>
    </Modal>
</template>

<style scoped>
.cropper {
    height: 400px;
}
</style>