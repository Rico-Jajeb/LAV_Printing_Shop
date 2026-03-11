<template>
    <AdminHeader />
    <main class="flex min-h-screen">
        <SidebarAdmin />
        <div
            :class="[
                {
                    'bg-blue-50': colorDefault === 'blue',
                    'bg-yellow-50': colorDefault === 'yellow',
                    'bg-red-50': colorDefault === 'red',
                    'bg-pink-50': colorDefault === 'pink',
                    'bg-teal-50': colorDefault === 'teal',
                    'bg-gray-50': colorDefault === 'black',
                },
                'w-full pt-14',
            ]"
        >
            <slot />
        </div>
    </main>
    <!-- kanan Notif -->
    <Toast />
</template>
<script setup>
import AdminHeader from "@/Components/Header/AdminHeader.vue";
import SidebarAdmin from "@/Components/Navigation/SidebarAdmin.vue";
import Toast from "primevue/toast";

import { useColor } from "@/Composables/useColor";
const {
    colorDefault,
} = useColor();
</script>
