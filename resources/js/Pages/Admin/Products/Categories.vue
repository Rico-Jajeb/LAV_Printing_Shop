<template>
    <main class="mt-8 px-8">
        <!-- Amo ini an kanan BreadCrump -->
        <section>
            <nav class="flex" aria-label="Breadcrumb">
                <ol
                    class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
                >
                    <li class="inline-flex items-center">
                        <NavLink
                            :href="route('dashboard')"
                            class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand"
                            prefetch
                            cache-for="30s"
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
                                prefetch
                                cache-for="30s"
                                >Products</NavLink
                            >
                        </div>
                    </li>
                </ol>
            </nav>
        </section>

        <!-- amo ini an kanan header -->
        <section class="mt-4 sm:flex sm:justify-between">
            <div>
                <h1 class="mb-2 font-bold text-3xl">Categories</h1>
                <p class="text-body">
                    Manage your product category and listings.
                </p>
            </div>
            <div class="sm:flex gap-4 sm:items-center sm:mt-0 mt-4">
                <Link
                    href="/add-place-category"
                    class="flex items-center sm:mb-0 mb-2 px-2 py-1.5 bg-green-300 text-body rounded-base hover:bg-green-500 hover:text-black group"
                >
                    <svg
                        class="w-6 h-6 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                            clip-rule="evenodd"
                        />
                    </svg>

                    <span class="ms-3">Add Category</span>
                </Link>
           
            </div>
        </section>

        <section class="mt-4">
            <CategoryTable  :category="category"  />
        </section>


    </main>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from '@inertiajs/vue3'
import CategoryTable from "@/Pages/Admin/Products/CategoryTable.vue";




const props = defineProps({
    category: Array
});

defineOptions({
    layout: AdminLayout,
});
</script>
