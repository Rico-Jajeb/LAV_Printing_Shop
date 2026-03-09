<template>
  <main class="">
        <Form action="/users" method="post">
            <div class="mb-4">
                <label
                    for="name"
                    class="block mb-2.5 text-sm font-medium text-heading"
                    > Category name <span class="text-red-600">*</span></label
                >
                <div class="flex items-center">
                    <InputText
                        name="name"
                        type="text"
                        id="name"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                        placeholder="Category name"
                        required
                    />
                </div>
            </div>
            <div class="mb-4">
                <label
                    for="description"
                    class="block mb-2.5 text-sm font-medium text-heading"
                    >Description <span class="text-red-600">*</span></label
                >
                <div class="flex items-center">
                    <InputText
                        name="description"
                        type="text"
                        id="description"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                        placeholder="Description.."
                        required
                    />
                </div>
            </div>


            <Button type="submit" >Submit</Button>
        </Form>    
  </main>

</template>
<script setup>
import { InputText } from "primevue";
import { Form } from "@inertiajs/vue3";

import { Button } from "primevue";

</script>
