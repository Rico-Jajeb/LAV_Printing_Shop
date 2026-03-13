import { ref } from "vue";

export function useImagePreview() {
    const previewSrc = ref<string | null>(null);

    const onFileSelect = (event: Event, onFilePicked?: (file: File) => void) => {
        const input = event.target as HTMLInputElement;
        const file = input.files?.[0];
        if (!file) return;

        onFilePicked?.(file);

        const reader = new FileReader();
        reader.onload = (e) => {
            previewSrc.value = (e.target?.result as string) ?? null;
        };
        reader.readAsDataURL(file);
    };

    const clearPreview = () => {
        previewSrc.value = null;
    };

    return { previewSrc, onFileSelect, clearPreview };
}