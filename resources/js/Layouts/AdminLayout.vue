<template>
    <AdminHeader />
    <main class="flex min-h-screen">
        <SidebarAdmin />
        <div class="w-full pt-14 bg-gray-200">
            <slot />
        </div>
    </main>
    <!-- kanan Notif -->
    <Toast />
</template>
<script setup>
import AdminHeader from "@/Components/Header/AdminHeader.vue";
import SidebarAdmin from "@/Components/Navigation/SidebarAdmin.vue";
import Toast from 'primevue/toast'

</script>
