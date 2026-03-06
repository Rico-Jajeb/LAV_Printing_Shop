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



    
  </main>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Badge from "primevue/badge";
import OverlayBadge from "primevue/overlaybadge";
import { useColor } from "@/Composables/useColor";




const {  themeColor1, themeColor2, themeColor3, colorDefault } = useColor()

defineOptions({
  layout: AdminLayout,
});
</script>