<template>
    <form action="" class="mt-8">
        <section class="grid grid-cols-6 gap-4">
            <section
                class="sm:col-span-4 col-span-6 bg-neutral-primary-soft block p-6 border border-default rounded-lg shadow-xs"
            >
                <h1 class="text-2xl font-bold">Product Information</h1>

                <div class="mt-4">
                        <label
                            for="first_name"
                            class="block mb-2.5 text-sm font-medium text-heading"
                            >Product Name
                            <span class="text-red-600">*</span></label
                        >
                        <InputText
                            type="text"
                            id="product_name"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                            placeholder="Enter Product name..."
                            required
                        />
                </div>
                <section class="mt-4 grid grid-cols-2 gap-8">
                    <div class="sm:col-span-1 col-span-2">
                        <label
                            for="first_name"
                            class="block mb-2.5 text-sm font-medium text-heading"
                            >SKU
                            <span class="text-red-600">*</span></label
                        >
                        <InputText
                            type="text"
                            id="sku"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                            placeholder="e.g., PRD-2026-001"
                            required
                        />
                    </div>
                    <div class="sm:col-span-1 col-span-2">
                        <label
                            for="countries"
                            class="block mb-2.5 text-sm font-medium text-heading"
                            >Category <span class="text-red-600">*</span></label
                        >
                        <Select
                             v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Select a City"
                            class="block w-full px-3  bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
                        />
                         
                     
                    </div>
                </section>

                <div class="mt-4">
                    <label
                        for="message"
                        class="block mb-2.5 text-sm font-medium text-heading"
                        >Description <span class="text-red-600">*</span></label
                    >
                    <Textarea
                        id="message"
                        rows="4"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body"
                        placeholder="Enter Product description"
                    ></Textarea>
                </div>

             
            </section>

            <div
                class="sm:col-span-2 col-span-6 bg-neutral-primary-soft block p-6 border border-default rounded-lg shadow-xs"
            >
                <h1 class="text-2xl font-bold">Place Image</h1>
                <h1 class="mt-1 text-sm">
                    Maximum Image size: 10mb <span class="text-red-600">*</span>
                </h1>
                <div class="mt-4 flex items-center justify-center w-full">
                    <label
                        for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 bg-neutral-secondary-medium border border-dashed border-default-strong rounded-lg cursor-pointer hover:bg-neutral-tertiary-medium"
                    >
                        <div
                            class="flex flex-col items-center justify-center text-body pt-5 pb-6"
                        >
                            <svg
                                class="w-8 h-8 mb-4"
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
                                    d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2"
                                />
                            </svg>
                            <p class="mb-2 text-sm">
                                <span class="font-semibold"
                                    >Click to upload</span
                                >
                                or drag and drop
                            </p>
                            <p class="text-xs">
                                SVG, PNG, JPG or GIF (MAX. 800x400px)
                            </p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" />
                    </label>
                </div>
            </div>

</section>

        <!-- amo ini an kanan Contacts and status -->
        <section class="grid grid-cols-6 gap-4 mt-8">
            <section
                class="sm:col-span-4 col-span-6 bg-neutral-primary-soft block p-6 border border-default rounded-lg shadow-xs"
            >
                <h1 class="text-2xl font-bold">Pricing & Inventory</h1>

                <section class="grid grid-cols-2 mt-4 gap-8">
                    <div class="sm:col-span-1 col-span-2">
                        <label
                            for="first_name"
                            class="block mb-2.5 text-sm font-medium text-heading"
                            >Selling Price <span class="text-red-600">*</span></label
                        >
                        <div class="flex items-center">
                    
                            <InputText
                                type="number"
                                id="price"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                placeholder="₱"
                                required
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-1 col-span-2">
                        <label
                            for="first_name"
                            class="block mb-2.5 text-sm font-medium text-heading"
                            >Stock Quantity
                            <span class="text-red-600">*</span></label
                        >
                        <div class="flex items-center">
                       

                            <InputText
                                type="number"
                                id="Stock_quantity"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                placeholder="0"
                                required
                            />
                        </div>
                    </div>
                </section>
                <section class="grid grid-cols-2 mt-4 gap-8">
                    <div class="sm:col-span-1 col-span-2">
                        <label
                            for="first_name"
                            class="block mb-2.5 text-sm font-medium text-heading"
                            >Cost Price <span class="text-red-600">*</span></label
                        >
                        <div class="flex items-center">
                      

                            <InputText
                                type="number"
                                id="cost_price"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                placeholder="₱"
                                required
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-1 col-span-2">
                        <label
                            for="first_name"
                            class="block mb-2.5 text-sm font-medium text-heading"
                            >Supplier <span class="text-red-600">*</span></label
                        >
                        <div class="flex items-center">
                         

                            <InputText
                                type="email"
                                id="first_name"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                placeholder="Supplier name"
                                required
                            />
                        </div>
                    </div>
                </section>
               
                

            </section>

            <!-- amo ini kanan Submit  -->
            <section
                class="sm:col-span-2 col-span-6 h-46 bg-neutral-primary-soft block p-6 border border-default rounded-lg shadow-xs"
            >
                <h1 class="text-2xl font-bold">Actions</h1>

                <div class=" pt-8">
                  
                    <div class="flex items-center">
                        <button class="flex items-center justify-center w-full bg-green-300 px-4 py-3 rounded-lg">
                                <svg
                                    class="w-6 h-6 mr-2 text-gray-800 dark:text-white"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z"
                                    />
                                    <path
                                        fill-rule="evenodd"
                                        d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>

                                Save Product
                            </button>
                    </div>
                    <div class="flex items-center mt-4">
                        <button class="flex items-center justify-center w-full bg-green-300 px-4 py-3 rounded-lg">
                                <svg
                                    class="w-6 h-6 mr-2 text-gray-800 dark:text-white"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z"
                                    />
                                    <path
                                        fill-rule="evenodd"
                                        d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>

                               Reset
                            </button>
                    </div>
                </div>
            </section>
        </section>

   

     
    </form>
</template>
<script setup>
import { ref } from "vue";
import InputText from "primevue/inputtext";
import Textarea from 'primevue/textarea';
import Select from 'primevue/select';
import { usePrimeVue } from 'primevue/config';
import { useToast } from "primevue/usetoast";

import FileUpload from 'primevue/fileupload';

const selectedCity = ref();
const cities = ref([
    { name: 'New York', code: 'NY' },
    { name: 'Rome', code: 'RM' },
    { name: 'London', code: 'LDN' },
    { name: 'Istanbul', code: 'IST' },
    { name: 'Paris', code: 'PRS' }
]);



</script>
