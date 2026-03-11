<template>
    <main class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
        <!-- View Toggle -->
        <div class="flex justify-between items-center mb-4">
            <IconField>
                <InputIcon>
                    <i class="pi pi-search" />
                </InputIcon>
                <InputText
                    v-model="filters['global'].value"
                    placeholder="Global Search"
                />
            </IconField>

            <div class="flex gap-2">
                <Button
                    :outlined="viewMode !== 'table'"
                    icon="pi pi-list"
                    @click="viewMode = 'table'"
                    aria-label="Table view"
                    v-tooltip="'Table View'"
                />
                <Button
                    :outlined="viewMode !== 'card'"
                    icon="pi pi-th-large"
                    @click="viewMode = 'card'"
                    aria-label="Card view"
                    v-tooltip="'Card View'"
                />
            </div>
        </div>

        <!-- TABLE VIEW -->
        <div v-if="viewMode === 'table'" class="card">
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
                <Column field="image" header="Image" style="width: 10%">
                    <template #body="{ data }">
                        <Image
                            v-if="data.image_url"
                            :src="data.image_url"
                            :alt="data.name"
                            width="50"
                            style="height: 50px; object-fit: cover; border-radius: 4px;"
                            preview
                        />
                        <span v-else>No image</span>
                    </template>
                </Column>

                <Column field="name" header="Name" sortable style="width: 25%">
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
                    </template>
                </Column>

                <Column field="description" header="Description" sortable style="width: 25%">
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Search description" />
                    </template>
                </Column>

                <Column field="status" header="Status" sortable filterMatchMode="equals" style="width: 10%">
                    <template #body="{ data }">
                        <ToggleSwitch :modelValue="data.status" @change="updateStatus(data)" />
                    </template>
                    <template #filter="{ filterModel }">
                        <Select v-model="filterModel.value" :options="statuses" placeholder="Select One" showClear>
                            <template #option="slotProps">
                                <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)" />
                            </template>
                        </Select>
                    </template>
                </Column>

                <Column field="Action" header="Action" style="width: 10%">
                    <template #body="{ data }">
                        <section class="flex gap-4">
                            <button @click="$emit('edit', data)">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                </svg>
                            </button>
                            <button @click="confirmDelete(data.id)" class="cursor-pointer text-red-600">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                </svg>
                            </button>
                        </section>
                    </template>
                </Column>

                <template #empty>
                    <Deferred :data="['category']">
                        <template #fallback>
                            <ProgressSpinner style="width: 15px; height: 15px" strokeWidth="8" fill="transparent" animationDuration=".5s" aria-label="Custom ProgressSpinner" />
                            Fetching categories…
                        </template>
                        <template #default>No categories found.</template>
                    </Deferred>
                </template>
            </DataTable>
        </div>

        <!-- CARD VIEW -->
        <div v-else>
             <Deferred :data="['category']">

<template #fallback>
    <div style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 48px 0; color: #6b7280;">
        <svg
            style="width: 15px; height: 15px; flex-shrink: 0; animation: card-spin 0.5s linear infinite;"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <circle cx="12" cy="12" r="10" stroke="#e5e7eb" stroke-width="4"/>
            <path d="M12 2a10 10 0 0 1 10 10" stroke="#6b7280" stroke-width="4" stroke-linecap="round"/>
        </svg>
        <span style="line-height: 1;">Fetching categories…</span>
    </div>
</template>

         <template #default>
            <!-- Empty State -->
            <div v-if="filteredCategories.length === 0" class="text-center py-12 text-gray-500">
                <i class="pi pi-inbox text-4xl mb-3 block"></i>
                No categories found.
            </div>

            <!-- Cards Grid -->
            <div v-else  class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                <div
                    v-for="item in paginatedCategories"
                    :key="item.id"
                    class="relative bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-visible"
                >
                    <!-- Three-dot menu button -->
                    <div class="absolute top-3 right-3 z-10">
                        <button
                            @click.stop="toggleMenu(item.id)"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-white/80 hover:bg-gray-100 shadow transition"
                        >
                            <i class="pi pi-ellipsis-v text-gray-600"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            v-if="openMenuId === item.id"
                            class="absolute right-0 mt-1 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50 py-1"
                            @click.stop
                        >
                            <!-- Edit -->
                            <button
                                @click="$emit('edit', item); closeMenu()"
                                class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition"
                            >
                                <i class="pi pi-pencil text-blue-500"></i>
                                Edit
                            </button>

                            <!-- Status Toggle -->
                            <div class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <span class="flex items-center gap-2">
                                    <i class="pi pi-power-off" :class="item.status ? 'text-green-500' : 'text-gray-400'"></i>
                                    {{ item.status ? 'Active' : 'Inactive' }}
                                </span>
                                <ToggleSwitch :modelValue="item.status" @change="updateStatus(item)" />
                            </div>

                            <div class="border-t border-gray-100 my-1"></div>

                            <!-- Delete -->
                            <button
                                @click="confirmDelete(item.id); closeMenu()"
                                class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition"
                            >
                                <i class="pi pi-trash"></i>
                                Delete
                            </button>
                        </div>
                    </div>

                
                    <!-- Image -->
                    <div class="w-full h-48 bg-gray-100 overflow-hidden rounded-t-xl">
                        <img
                            v-if="item.image_url"
                            :src="item.image_url"
                            :alt="item.name"
                            class="w-full h-full object-cover"
                        />
                        <div v-else class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="pi pi-image text-4xl"></i>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 text-base truncate">{{ item.name }}</h3>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ item.description || 'No description.' }}</p>

                        <!-- Status Badge -->
                        <span
                            class="inline-block mt-3 text-xs font-medium px-2 py-0.5 rounded-full"
                            :class="item.status
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-600'"
                        >
                            {{ item.status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Pagination -->
            <div class="flex justify-between items-center mt-6">
                <span class="text-sm text-gray-500">
                    Showing {{ cardStart + 1 }}–{{ Math.min(cardStart + cardRows, filteredCategories.length) }} of {{ filteredCategories.length }}
                </span>
                <Paginator
                    :rows="cardRows"
                    :totalRecords="filteredCategories.length"
                    @page="onCardPageChange"
                    :rowsPerPageOptions="[8, 12, 24]"
                />
            </div>
            </template>
            </Deferred>
        </div>

        <ConfirmDialog />
    </main>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import { FilterMatchMode } from "@primevue/core/api";
import { Deferred } from "@inertiajs/vue3";

import DataTable from "primevue/datatable";
import Column from "primevue/column";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import Select from "primevue/select";
import Tag from "primevue/tag";
import ProgressSpinner from "primevue/progressspinner";
import Image from "primevue/image";
import { Button } from "primevue";
import ConfirmDialog from "primevue/confirmdialog";
import ToggleSwitch from "primevue/toggleswitch";
import Paginator from "primevue/paginator";

import { router } from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";
import { useConfirm } from "primevue/useconfirm";

const confirm = useConfirm();
const toast = useToast();

const props = defineProps({
    category: Array,
});

const emit = defineEmits(["edit"]);

// View toggle
const viewMode = ref("table"); // 'table' | 'card'

// Three-dot menu state
const openMenuId = ref(null);

const toggleMenu = (id) => {
    openMenuId.value = openMenuId.value === id ? null : id;
};

const closeMenu = () => {
    openMenuId.value = null;
};

// Close menu on outside click
const handleOutsideClick = () => closeMenu();
onMounted(() => document.addEventListener("click", handleOutsideClick));
onBeforeUnmount(() => document.removeEventListener("click", handleOutsideClick));

// Card pagination
const cardRows = ref(8);
const cardStart = ref(0);

const onCardPageChange = (event) => {
    cardStart.value = event.first;
    cardRows.value = event.rows;
};

// Filtered categories (respects global search for card view)
const filteredCategories = computed(() => {
    const search = filters.value["global"].value?.toLowerCase();
    if (!search) return props.category ?? [];
    return (props.category ?? []).filter(
        (c) =>
            c.name?.toLowerCase().includes(search) ||
            c.description?.toLowerCase().includes(search)
    );
});

const paginatedCategories = computed(() =>
    filteredCategories.value.slice(cardStart.value, cardStart.value + cardRows.value)
);

// Selection & filters
const selectedCategory = ref();

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { value: null, matchMode: FilterMatchMode.CONTAINS },
    description: { value: null, matchMode: FilterMatchMode.CONTAINS },
    image: { value: null, matchMode: FilterMatchMode.CONTAINS },
    status: { value: null, matchMode: FilterMatchMode.EQUALS },
});

const statuses = [true, false];

const getSeverity = (status) => (status ? "success" : "danger");

const updateStatus = (data) => {
    data.status = !data.status;
    router.patch(
        `/category/${data.id}/status`,
        { status: data.status },
        {
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    severity: "success",
                    summary: "Updated",
                    detail: `Category ${data.status ? "activated" : "deactivated"} successfully!`,
                    life: 3000,
                });
            },
            onError: () => {
                data.status = !data.status;
                toast.add({
                    severity: "error",
                    summary: "Error",
                    detail: "Failed to update status!",
                    life: 3000,
                });
            },
        }
    );
};

const confirmDelete = (id) => {
    confirm.require({
        message: "Do you want to delete this record?",
        header: "Danger Zone",
        icon: "pi pi-info-circle",
        rejectProps: { label: "Cancel", severity: "secondary", outlined: true },
        acceptProps: { label: "Delete", severity: "danger" },
        accept: () => {
            router.delete(`/category/${id}`, {
                onSuccess: () => toast.add({ severity: "success", summary: "Deleted", detail: "Category deleted successfully!", life: 3000 }),
                onError: () => toast.add({ severity: "error", summary: "Error", detail: "Failed to delete category!", life: 3000 }),
            });
        },
        reject: () => toast.add({ severity: "warn", summary: "Cancelled", detail: "Delete cancelled", life: 3000 }),
    });
};
</script>

<style scoped>
@keyframes card-spin {
    to { transform: rotate(360deg); }
      to { transform: rotate(360deg); }
}
</style>