import { useForm } from "@inertiajs/vue3";
import { watch, type Ref } from "vue";
import { useToast } from "primevue/usetoast";

interface Category {
    id: number;
    name: string;
    description: string;
    status: boolean;
    image_url?: string | null;
}

interface CategoryFormProps {
    category?: Category | null;
}

export function useCategoryForm(
    props: CategoryFormProps,
    previewSrc: Ref<string | null>
) {
    const toast = useToast();

    const form = useForm({
        name: "",
        description: "",
        status: true,
        image: null as File | null,
    });

    watch(
        () => props.category,
        (newVal) => {
            if (newVal) {
                form.name = newVal.name ?? "";
                form.description = newVal.description ?? "";
                form.status = newVal.status ?? true;
                form.image = null;
                previewSrc.value = newVal.image_url ?? null;
            } else {
                form.name = "";
                form.description = "";
                form.status = true;
                form.image = null;
                previewSrc.value = null;
            }
        },
        { immediate: true }
    );

    const submit = () => {
        if (props.category) {
            form.transform((data) => ({
                ...data,
                _method: "PUT",
            })).post(`/category/update/${props.category.id}`, {
                forceFormData: true,
                onSuccess: () => {
                    toast.add({
                        severity: "success",
                        summary: "Success",
                        detail: "Category Updated Successfully!",
                        life: 20000,
                    });
                },
                onError: () => {
                    toast.add({
                        severity: "error",
                        summary: "Error",
                        detail: "Failed to update category. Please check the form.",
                        life: 20000,
                    });
                },
            });
        } else {
            form.post("/category/create", {
                forceFormData: true,
                onSuccess: () => {
                    toast.add({
                        severity: "success",
                        summary: "Success",
                        detail: "Category Added Successfully!",
                        life: 20000,
                    });
                },
                onError: () => {
                    toast.add({
                        severity: "error",
                        summary: "Error",
                        detail: "Failed to create category. Please check the form.",
                        life: 20000,
                    });
                },
            });
        }
    };

    return { form, submit };
}