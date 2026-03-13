<template>
    <main class="">
        <Form @submit.prevent="submit" enctype="multipart/form-data">
            <div class="mb-4">
                <label
                    for="name"
                    class="block mb-2.5 text-sm font-medium text-heading"
                >
                    Category name <span class="text-red-600">*</span></label
                >
                <div class="flex items-center">
                    <InputText
                        v-model="form.name"
                        name="name"
                        type="text"
                        id="name"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                        placeholder="Category name"
                        required
                    />
                </div>
                <span class="text-red-500" v-if="form.errors.name">{{
                    form.errors.name
                }}</span>
            </div>
            <div class="mb-4">
                <label
                    for="description"
                    class="block mb-2.5 text-sm font-medium text-heading"
                    >Description <span class="text-red-600">*</span></label
                >
                <div class="flex items-center">
                    <InputText
                        v-model="form.description"
                        name="description"
                        type="text"
                        id="description"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                        placeholder="Description.."
                        required
                    />
                </div>
                <span class="text-red-500" v-if="form.errors.description">{{
                    form.errors.description
                }}</span>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium"
                    >Category Image</label
                >
                <div class="flex flex-col items-center gap-3">
                    <label
                        class="cursor-pointer flex items-center gap-2 px-4 py-2 text-sm border border-default-medium rounded-base bg-neutral-secondary-medium hover:bg-neutral-300 transition"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4"
                            />
                        </svg>
                        {{ form.image ? form.image.name : "Choose Image" }}
                   <input
    type="file"
    accept="image/*"
    class="hidden"
    @change="(event) => onFileSelect(event, (file) => form.image = file)"
/>
                    </label>

                    <img
                        v-if="previewSrc"
                        :src="previewSrc"
                        alt="Category Image Preview"
                        class="shadow-md rounded-xl w-full sm:w-64 object-cover"
                        style="height: 160px"
                    />
                    <span v-else class="text-sm text-body"
                        >No image selected</span
                    >
                </div>
            </div>

            <ToggleSwitch class="!hidden" v-model="form.status" />
            <Button type="submit">Submit</Button>
        </Form>
    </main>
</template>
<script setup lang="ts">
import { InputText, Button, ToggleSwitch } from "primevue";
import { Form } from "@inertiajs/vue3";
import { useCategoryForm } from "@/Composables/Products/useCategoryForm";
import { useImagePreview } from "@/Composables/Products/useImagePreview";

interface Category {
    id: number;
    name: string;
    description: string;
    status: boolean;
    image_url?: string | null;
}

const props = defineProps<{ category?: Category | null }>();

const { previewSrc, onFileSelect } = useImagePreview();
const { form, submit } = useCategoryForm(props, previewSrc);
</script>
