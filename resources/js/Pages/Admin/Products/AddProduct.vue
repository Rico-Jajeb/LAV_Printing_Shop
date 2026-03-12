<template>
  <main class="mt-4 mx-8">
    <!-- Breadcrump ini -->
    <nav class="flex" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
          <NavLink
            :href="route('dashboard')"
            class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand"
          >
            <svg
              class="w-4 h-4 me-1.5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"
              />
            </svg>
          </NavLink>
        </li>
        <li>
          <div class="flex items-center space-x-1.5">
            <svg
              class="w-3.5 h-3.5 rtl:rotate-180 text-body"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m9 5 7 7-7 7"
              />
            </svg>
            <NavLink
               :href="route('products')"
              class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand"
            >
              Products
            </NavLink>
          </div>
        </li>
        <li>
          <div class="flex items-center space-x-1.5">
            <svg
              class="w-3.5 h-3.5 rtl:rotate-180 text-body"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m9 5 7 7-7 7"
              />
            </svg>
            <NavLink
               :href="route('addProducts')"
              class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand"
            >
              Add Product
            </NavLink>
          </div>
        </li>
      </ol>
    </nav>

    <!-- amo ini an header an -->
    <section class="mt-4">
      <!-- <div>
        <h1 class="mb-2 font-bold text-2xl">Add New Product's</h1>
        <p class="text-body">Create a new product and add it to your inventory.</p>
      </div> -->
      <!-- Page header -->
<h1 class="mb-2 font-bold text-3xl">
    {{ product ? 'Edit Product' : 'Add Product' }}
</h1>
<p class="text-body">
    {{ product ? 'Update product details.' : 'Add a new product to your inventory.' }}
</p>
    </section>

    <section class="mt-4">
      <!-- <FormAddProduct :category="category" /> -->
       <FormAddProduct :product="product" :category="category" />
    </section>
  </main>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import FormAddProduct from '@/Pages/Admin/Products/FormAddProduct.vue';
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    // product: Array,
    product: { type: Object, default: null },
    category: Array,
});


defineOptions({
    layout: AdminLayout
})
</script>
