<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Test from '@/Pages/Test.vue';



defineOptions({
    layout: AdminLayout,
});
</script>

<template>
  

        <div class="py-12" title="Dashboard">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Test />
                
                </div>
            </div>
        </div>
   
</template>
