<template>
  <main class="py-12 mt-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<h1
  :class="[
    {
      'bg-blue-500': colorDefault === 'blue',
      'bg-yellow-400': colorDefault === 'yellow',
      'bg-red-600': colorDefault === 'red'
    },
    'text-white px-4 py-2 rounded'
  ]"
>
  this is setting
</h1>
    </div>

  <button
        @click="toggleProducts"
        class="flex items-center w-full hover:bg-teal-100 px-3 py-2 rounded text-gray-600"
    >
        <svg
            class="w-6 h-6 mr-2"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                fill-rule="evenodd"
                d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z"
                clip-rule="evenodd"
            />
        </svg>

        <span v-if="isVisible">Products</span>
    </button>

    <!-- DROPDOWN -->
    <div v-if="showProductsMenu" class="ml-8 mt-1 space-y-1">

        <NavLink
            :href="route('products.index')"
            class="block px-3 py-2 text-gray-600 hover:bg-teal-100 rounded"
        >
            All Products
        </NavLink>

        <NavLink
            :href="route('categories.index')"
            class="block px-3 py-2 text-gray-600 hover:bg-teal-100 rounded"
        >
            Categories
        </NavLink>

        <NavLink
            :href="route('id-printing.index')"
            class="block px-3 py-2 text-gray-600 hover:bg-teal-100 rounded"
        >
            ID Printing
        </NavLink>

    </div>

    
  </main>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Badge from "primevue/badge";
import OverlayBadge from "primevue/overlaybadge";
import { useColor } from "@/Composables/useColor";

import { ref } from 'vue'
import NavLink from "@/Components/NavLink.vue";
const showProductsMenu = ref(false)

function toggleProducts() {
    showProductsMenu.value = !showProductsMenu.value
}


const {  themeColor1, themeColor2, themeColor3, colorDefault } = useColor()

defineOptions({
  layout: AdminLayout,
});
</script>