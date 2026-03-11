<template>
    <main class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
        <div class="card">
            <DataTable
                v-model:filters="filters"
                v-model:selection="selectedCategory"
                :value="category"
                stateStorage="session"
                stateKey="dt-state-demo-session"
                paginator
                :rows="5"
                filterDisplay="menu"
                selectionMode="single"
                dataKey="id"
                :globalFilterFields="['name', 'description', 'status', 'image']"
                tableStyle="min-width: 50rem"
            >
                <template #header>
                    <IconField>
                        <InputIcon>
                            <i class="pi pi-search" />
                        </InputIcon>
                        <InputText
                            v-model="filters['global'].value"
                            placeholder="Global Search"
                        />
                    </IconField>
                </template>
                <Column field="name" header="Name" sortable style="width: 25%">
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            placeholder="Search by name"
                        />
                    </template>
                </Column>

                <Column
                    field="description"
                    header="Description"
                    sortable
                    style="width: 25%"
                >
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            placeholder="Search description"
                        />
                    </template>
                </Column>
                <Column field="image" header="Image" style="width: 10%">
                    <template #body="{ data }">
                        <Image
                            v-if="data.image_url"
                            :src="data.image_url"
                            :alt="data.name"
                            width="50"
                            style="
                                height: 50px;
                                object-fit: cover;
                                border-radius: 4px;
                            "
                            preview
                        />
                        <span v-else>No image</span>
                    </template>
                </Column>

                <Column
                    field="status"
                    header="Status"
                    sortable
                    filterMatchMode="equals"
                    style="width: 25%"
                >
                    <template #body="{ data }">
                        <!-- <Tag
                            :value="data.status"
                            :severity="getSeverity(data.status)"
                        /> -->
                           <ToggleSwitch
                                :modelValue="data.status"
                                @change="updateStatus(data)"
                            />
                    </template>
                    <template #filter="{ filterModel }">
                        <Select
                            v-model="filterModel.value"
                            :options="statuses"
                            placeholder="Select One"
                            showClear
                        >
                            <template #option="slotProps">
                                <Tag
                                    :value="slotProps.option"
                                    :severity="getSeverity(slotProps.option)"
                                />
                            </template>
                        </Select>
                    </template>
                </Column>

                <Column
                    field="Action"
                    header="Action"
                    filterMatchMode="equals"
                    style="width: 10%"
                >
                    <template #body="{ data }">
                        <section class="flex gap-4">
                            <div class="">
                                <button @click="$emit('edit', data)">
                                    <svg
                                        class="w-6 h-6 text-gray-800 dark:text-white"
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
                                            d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <div class="">
                                <button
                                    @click="confirmDelete(data.id)"
                                    class="cursor-pointer text-red-600 flex items-center gap-1"
                                >
                                    <svg
                                        class="w-6 h-6 text-gray-800 dark:text-white"
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
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </section>
                    </template>
                </Column>
                <!-- amo ini an loading kann category data, tapos kun waray data ma display na waray data -->
                <template #empty>
                    <Deferred :data="['category']">
                        <template #fallback>
                            <ProgressSpinner
                                style="width: 15px; height: 15px"
                                strokeWidth="8"
                                fill="transparent"
                                animationDuration=".5s"
                                aria-label="Custom ProgressSpinner"
                            />
                            Fetching categories…
                        </template>
                        <template #default> No categories found. </template>
                    </Deferred>
                </template>
            </DataTable>
        </div>
        <ConfirmDialog />
    </main>
</template>
<script setup>
import { ref, onMounted, computed } from "vue";
import { FilterMatchMode, FilterOperator } from "@primevue/core/api";
import { Deferred } from "@inertiajs/vue3";

import DataTable from "primevue/datatable";
import Column from "primevue/column";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import ColumnGroup from "primevue/columngroup"; // optional
import Row from "primevue/row"; // optional
import Select from "primevue/select";
import Tag from "primevue/tag";
import ProgressSpinner from "primevue/progressspinner";
import Image from "primevue/image";

import { Button } from "primevue";
import ConfirmDialog from "primevue/confirmdialog";
import { router } from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";
import { useConfirm } from "primevue/useconfirm";

import ToggleSwitch from 'primevue/toggleswitch';

const confirm = useConfirm();
const toast = useToast();

const props = defineProps({
    category: Array,
});




const selectedCategory = ref();

// kanan update categ
const editCategory = (category) => {
  selectedCategory.value = category
  visible.value = true
}

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },

    name: { value: null, matchMode: FilterMatchMode.CONTAINS },

    description: { value: null, matchMode: FilterMatchMode.CONTAINS },

    image: { value: null, matchMode: FilterMatchMode.CONTAINS },

    status: { value: null, matchMode: FilterMatchMode.EQUALS },
});

const getSeverity = (status) => {
    return status ? "success" : "danger";
};


const updateStatus = (data) => {
    data.status = !data.status  // 👇 Optimistically toggle UI immediately

    router.patch(`/category/${data.id}/status`, 
        { status: data.status },
        {
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    severity: 'success',
                    summary: 'Updated',
                    detail: `Category ${data.status ? 'activated' : 'deactivated'} successfully!`,
                    life: 3000
                })
            },
            onError: () => {
                // 👇 Revert toggle if request fails
                data.status = !data.status
                toast.add({
                    severity: 'error',
                    summary: 'Error',
                    detail: 'Failed to update status!',
                    life: 3000
                })
            }
        }
    )
}


const confirmDelete = (id) => {
    confirm.require({
        message: "Do you want to delete this record?",
        header: "Danger Zone",
        icon: "pi pi-info-circle",
        rejectProps: {
            label: "Cancel",
            severity: "secondary",
            outlined: true,
        },
        acceptProps: {
            label: "Delete",
            severity: "danger",
        },
        accept: () => {
            router.delete(`/category/${id}`, {
                onSuccess: () => {
                    toast.add({
                        severity: "success",
                        summary: "Deleted",
                        detail: "Category deleted successfully!",
                        life: 3000,
                    });
                },
                onError: () => {
                    toast.add({
                        severity: "error",
                        summary: "Error",
                        detail: "Failed to delete category!",
                        life: 3000,
                    });
                },
            });
        },
        reject: () => {
            toast.add({
                severity: "warn",
                summary: "Cancelled",
                detail: "Delete cancelled",
                life: 3000,
            });
        },
    });
};
</script>
