<template>
    <AdminHeader />
    <main class="flex min-h-screen">
        <SidebarAdmin />
        <div class="w-full pt-14">
            <slot />
        </div>
    </main>
</template>
<script setup>
import AdminHeader from "@/Components/Header/AdminHeader.vue";
import SidebarAdmin from "@/Components/Navigation/SidebarAdmin.vue";
</script>
