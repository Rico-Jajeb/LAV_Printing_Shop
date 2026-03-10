<template>
  <main class="">
        <Form @submit.prevent="submit"  enctype="multipart/form-data">
            <div class="mb-4">
                <label
                    for="name"
                    class="block mb-2.5 text-sm font-medium text-heading"
                    > Category name <span class="text-red-600">*</span></label
                >
                <div class="flex items-center">
                    <InputText
                        v-model="form.name"
                        name="name"
                        type="text"
                        id="name"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                        placeholder="Category name"
                        required
                    />
                    <span v-if="form.errors.name">{{ form.errors.name }}</span>
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
                        v-model="form.description"
                        name="description"
                        type="text"
                        id="description"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                        placeholder="Description.."
                        required
                    />
                    <span v-if="form.errors.description">{{ form.errors.description }}</span>
                </div>
            </div>


                <div class="mb-4">
                    <label for="image" class="block mb-2 text-sm font-medium">Category Image</label>
                    <input type="file" id="image" @change="handleFileUpload" />
                </div>



            <ToggleSwitch class="!hidden" v-model="form.status" />
            <Button type="submit" >Submit</Button>
        </Form>    
  </main>

</template>
<script setup>
import { InputText } from "primevue";
import { useForm  } from "@inertiajs/vue3";
import { Button } from "primevue";
import { Form } from "@inertiajs/vue3";
import ToggleSwitch from 'primevue/toggleswitch';

import { useToast } from 'primevue/usetoast'
const toast = useToast()


const form = useForm({
  name: '',
  description: '',
  status: true,
  image: null,
});


const handleFileUpload = (e) => {
  form.image = e.target.files[0];
};


const submit = () => {  
  form.post('/category/create', {
    forceFormData: true, 

    onSuccess: () => {
      toast.add({
        severity: 'success',
        summary: 'Success',
        detail: 'Category Added Successfully!',
        life: 20000
      })
    },
    onError: () => {
      toast.add({
        severity: 'error',
        summary: 'Error',
        detail: 'Failed to create category. Please check the form.',
        life: 20000
      })
    }


  });
};

</script>
