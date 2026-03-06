import { ref } from 'vue'

// Shared state across all imports
const isVisible = ref<boolean>(true)

export function useButton() {
  function toggleDiv(): void {
    isVisible.value = !isVisible.value
  }

  return {
    isVisible,
    toggleDiv,
  }
}
