<template>
    <aside
        id="top-bar-sidebar"
        class="fixed top-0 left-0 pt-14 z-40 h-full transition-transform -translate-x-full sm:translate-x-0 border border-r-teal-300 0 sm:w-48 md:w-54 lg:w-54"
        aria-label="Sidebar"
    >

    

        <div class="h-full w-full px-3 py-4  bg-neutral-primary-soft">
            <NavLink class="block w-full"
                :href="route('dashboard')"
                :active="route().current('dashboard')"
            >
                Dashboard3
            </NavLink>
            <NavLink class="block w-full"
                :href="route('products')"
                :active="route().current('products')"
            >
                Products
            </NavLink>
        </div>
    </aside>
</template>
<script setup>
import NavLink from "@/Components/NavLink.vue";
</script>
