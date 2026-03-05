<template>
    
<AdminHeader/>
    <main class="grid grid-cols-9 min-h-screen">
        <section class="bg-red-200 col-span-0 sm:col-span-2 md:col-span-2 lg:col-span-2 xl:col-span-1">
            <SidebarAdmin/>
        </section>

        <section  class="bg-orange-200 col-span-9 sm:col-span-7 md:col-span-7 lg:col-span-7 xl:col-span-8 sm:ml-10 md:ml-4 lg:ml-16 xl:ml-16 2xl:ml-4 mt-14 p-4">
               <slot />
        </section>
    </main>
   
</template>
<script setup>
import AdminHeader from '@/Components/Header/AdminHeader.vue';
import SidebarAdmin from '@/Components/Navigation/SidebarAdmin.vue';

import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
</script>