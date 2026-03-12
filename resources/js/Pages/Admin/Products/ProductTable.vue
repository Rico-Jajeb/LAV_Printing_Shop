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
                v-model:selection="selectedProduct"
                :value="isLoading ? skeletonRows : product"
                stateStorage="session"
                stateKey="dt-state-demo-session"
                paginator
                :rows="5"
                filterDisplay="menu"
                selectionMode="single"
                dataKey="id"
                :globalFilterFields="[
                    'name',
                    'description',
                    'selling_price',
                    'cost_price',
                    'stock_quantity',
                    'supplier',
                    'status',
                    'image_url',
                ]"
                tableStyle="min-width: 50rem"
            >
                <Column field="image_url" header="Image" style="width: 10%">
                    <template #body="{ data }">
                        <template v-if="isLoading">
                            <Skeleton width="50px" height="50px" />
                        </template>
                        <template v-else>
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
                    </template>
                </Column>

                <Column field="name" header="Name" sortable style="width: 25%">
                    <template #body="{ data }">
                        <ProgressSpinner
                            v-if="isLoading"
                            style="width: 15px; height: 15px"
                            strokeWidth="8"
                            fill="transparent"
                            animationDuration=".5s"
                        />

                        <span v-else>{{ data.name }}</span>
                    </template>
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
                    <template #body="{ data }">
                        <Skeleton v-if="isLoading" width="80%" height="1rem" />
                        <span v-else>{{ data.description }}</span>
                    </template>

                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            placeholder="Search description"
                        />
                    </template>
                </Column>

                <!-- FIX: Use type="number" for price fields -->
                <Column
                    field="selling_price"
                    header="Selling Price"
                    sortable
                    style="width: 25%"
                >
                    <template #body="{ data }">
                        <Skeleton v-if="isLoading" width="80%" height="1rem" />
                        <span v-else>{{ data.selling_price }}</span>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputNumber
                            v-model="filterModel.value"
                            placeholder="Search selling price"
                            :minFractionDigits="0"
                        />
                    </template>
                </Column>

                <Column
                    field="cost_price"
                    header="Cost Price"
                    sortable
                    style="width: 25%"
                >
                    <template #body="{ data }">
                        <Skeleton v-if="isLoading" width="80%" height="1rem" />
                        <span v-else>{{ data.cost_price }}</span>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputNumber
                            v-model="filterModel.value"
                            placeholder="Search cost price"
                            :minFractionDigits="0"
                        />
                    </template>
                </Column>

                <Column
                    field="stock_quantity"
                    header="QTY"
                    sortable
                    style="width: 25%"
                >
                    <template #body="{ data }">
                        <Skeleton v-if="isLoading" width="80%" height="1rem" />
                        <span v-else>{{ data.stock_quantity }}</span>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputNumber
                            v-model="filterModel.value"
                            placeholder="Search quantity"
                        />
                    </template>
                </Column>

                <Column
                    field="supplier"
                    header="Supplier"
                    sortable
                    style="width: 25%"
                >
                    <template #body="{ data }">
                        <Skeleton v-if="isLoading" width="80%" height="1rem" />
                        <span v-else>{{ data.supplier }}</span>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText
                            v-model="filterModel.value"
                            type="text"
                            placeholder="Search supplier"
                        />
                    </template>
                </Column>

                <Column
                    field="status"
                    header="Status"
                    sortable
                    filterMatchMode="equals"
                    style="width: 10%"
                >
                    <template #body="{ data }">
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
                                    :value="
                                        slotProps.option ? 'Active' : 'Inactive'
                                    "
                                    :severity="getSeverity(slotProps.option)"
                                />
                            </template>
                        </Select>
                    </template>
                </Column>

                <Column field="Action" header="Action" style="width: 10%">
                    <template #body="{ data }">
                        <section class="flex gap-4">
                            <!-- <button @click="$emit('edit', data)"> -->
                            <button
                                @click="
                                    router.visit(
                                        route('products.edit', { id: data.id }),
                                    )
                                "
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
                                        d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"
                                    />
                                </svg>
                            </button>
                            <button
                                @click="confirmDelete(data)"
                                class="cursor-pointer text-red-600"
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
                        </section>
                    </template>
                </Column>

                <template #empty>
                    <Deferred :data="['product']">
                        <template #fallback>
                            <ProgressSpinner
                                style="width: 15px; height: 15px"
                                strokeWidth="8"
                                fill="transparent"
                                animationDuration=".5s"
                                aria-label="Custom ProgressSpinner"
                            />
                            Fetching products..
                        </template>
                        <template #default>No products found.</template>
                    </Deferred>
                </template>
            </DataTable>
        </div>

        <!-- CARD VIEW -->
        <div v-else>
            <Deferred :data="['product']">
                <template #fallback>
                    <div
                        style="
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 8px;
                            padding: 48px 0;
                            color: #6b7280;
                        "
                    >
                        <svg
                            style="
                                width: 15px;
                                height: 15px;
                                flex-shrink: 0;
                                animation: card-spin 0.5s linear infinite;
                            "
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="#e5e7eb"
                                stroke-width="4"
                            />
                            <path
                                d="M12 2a10 10 0 0 1 10 10"
                                stroke="#6b7280"
                                stroke-width="4"
                                stroke-linecap="round"
                            />
                        </svg>
                        <span style="line-height: 1">Fetching products…</span>
                    </div>
                </template>

                <template #default>
                    <!-- Empty State -->
                    <div
                        v-if="filteredCategories.length === 0"
                        class="text-center py-12 text-gray-500"
                    >
                        <i class="pi pi-inbox text-4xl mb-3 block"></i>
                        No products found.
                    </div>

                    <!-- Cards Grid -->
                    <div
                        v-else
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5"
                    >
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
                                    <i
                                        class="pi pi-ellipsis-v text-gray-600"
                                    ></i>
                                </button>

                                <!-- Dropdown Menu -->
                                <div
                                    v-if="openMenuId === item.id"
                                    class="absolute right-0 mt-1 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50 py-1"
                                    @click.stop
                                >
                                    <button
                                        @click="
                                            router.visit(
                                                route('products.edit', {
                                                    id: item.id,
                                                }),
                                            );
                                            closeMenu();
                                        "
                                        class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition"
                                    >
                                        <!-- <button
                                        @click="$emit('edit', item); closeMenu()"
                                        class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition"
                                    > -->
                                        <i
                                            class="pi pi-pencil text-blue-500"
                                        ></i>
                                        Edit
                                    </button>

                                    <div
                                        class="flex items-center justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition"
                                    >
                                        <span class="flex items-center gap-2">
                                            <i
                                                class="pi pi-power-off"
                                                :class="
                                                    item.status
                                                        ? 'text-green-500'
                                                        : 'text-gray-400'
                                                "
                                            ></i>
                                            {{
                                                item.status
                                                    ? "Active"
                                                    : "Inactive"
                                            }}
                                        </span>
                                        <ToggleSwitch
                                            :modelValue="item.status"
                                            @change="updateStatus(item)"
                                        />
                                    </div>

                                    <div
                                        class="border-t border-gray-100 my-1"
                                    ></div>

                                    <button
                                        @click="
                                            confirmDelete(item.id);
                                            closeMenu();
                                        "
                                        class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition"
                                    >
                                        <i class="pi pi-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>

                            <!-- Image -->
                            <div
                                class="w-full h-48 bg-gray-100 overflow-hidden rounded-t-xl"
                            >
                                <img
                                    v-if="item.image_url"
                                    :src="item.image_url"
                                    :alt="item.name"
                                    class="w-full h-full object-cover"
                                />
                                <div
                                    v-else
                                    class="w-full h-full flex items-center justify-center text-gray-400"
                                >
                                    <i class="pi pi-image text-4xl"></i>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h3
                                    class="font-semibold text-gray-800 text-base truncate"
                                >
                                    {{ item.name }}
                                </h3>
                                <p
                                    class="text-sm text-gray-500 mt-1 line-clamp-2"
                                >
                                    {{ item.description || "No description." }}
                                </p>

                                <!-- Price Info -->
                                <div
                                    class="mt-2 flex gap-3 text-xs text-gray-600"
                                >
                                    <span
                                        >Sell:
                                        <strong>{{
                                            item.selling_price
                                        }}</strong></span
                                    >
                                    <span
                                        >Cost:
                                        <strong>{{
                                            item.cost_price
                                        }}</strong></span
                                    >
                                    <span
                                        >QTY:
                                        <strong>{{
                                            item.stock_quantity
                                        }}</strong></span
                                    >
                                </div>

                                <!-- Status Badge -->
                                <span
                                    class="inline-block mt-3 text-xs font-medium px-2 py-0.5 rounded-full"
                                    :class="
                                        item.status
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-red-100 text-red-600'
                                    "
                                >
                                    {{ item.status ? "Active" : "Inactive" }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Pagination -->
                    <div class="flex justify-between items-center mt-6">
                        <span class="text-sm text-gray-500">
                            Showing {{ cardStart + 1 }}–{{
                                Math.min(
                                    cardStart + cardRows,
                                    filteredCategories.length,
                                )
                            }}
                            of {{ filteredCategories.length }}
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
// FIX: Import InputNumber for numeric fields
import InputNumber from "primevue/inputnumber";
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

import Skeleton from "primevue/skeleton";

const confirm = useConfirm();
const toast = useToast();

const props = defineProps({
    product: Array,
});

// kanan Skeleten ini para han table
const isLoading = computed(() => !props.product);
const skeletonRows = Array.from({ length: 5 }, (_, i) => ({ id: i }));

const emit = defineEmits(["edit"]);

const viewMode = ref("table");
const openMenuId = ref(null);

const toggleMenu = (id) => {
    openMenuId.value = openMenuId.value === id ? null : id;
};

const closeMenu = () => {
    openMenuId.value = null;
};

const handleOutsideClick = () => closeMenu();
onMounted(() => document.addEventListener("click", handleOutsideClick));
onBeforeUnmount(() =>
    document.removeEventListener("click", handleOutsideClick),
);

const cardRows = ref(8);
const cardStart = ref(0);

const onCardPageChange = (event) => {
    cardStart.value = event.first;
    cardRows.value = event.rows;
};

const filteredCategories = computed(() => {
    const search = filters.value["global"].value?.toLowerCase();
    if (!search) return props.product ?? [];
    return (props.product ?? []).filter(
        (c) =>
            c.name?.toLowerCase().includes(search) ||
            c.description?.toLowerCase().includes(search) ||
            String(c.selling_price)?.includes(search) ||
            String(c.cost_price)?.includes(search) ||
            String(c.stock_quantity)?.includes(search) ||
            c.supplier?.toLowerCase().includes(search),
    );
});

const paginatedCategories = computed(() =>
    filteredCategories.value.slice(
        cardStart.value,
        cardStart.value + cardRows.value,
    ),
);

const selectedProduct = ref();

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { value: null, matchMode: FilterMatchMode.CONTAINS },
    description: { value: null, matchMode: FilterMatchMode.CONTAINS },
    // FIX: Use EQUALS for numeric fields so InputNumber works correctly
    selling_price: { value: null, matchMode: FilterMatchMode.EQUALS },
    cost_price: { value: null, matchMode: FilterMatchMode.EQUALS },
    stock_quantity: { value: null, matchMode: FilterMatchMode.EQUALS },
    supplier: { value: null, matchMode: FilterMatchMode.CONTAINS },
    status: { value: null, matchMode: FilterMatchMode.EQUALS },
});

const statuses = [true, false];

const getSeverity = (status) => (status ? "success" : "danger");

const updateStatus = (data) => {
    data.status = !data.status;
    // FIX: Route corrected from /category/ to /product/
    router.patch(
        `/category/${data.id}/status`,
        { status: data.status },
        {
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    severity: "success",
                    summary: "Updated",
                    detail: `Product ${data.status ? "activated" : "deactivated"} successfully!`,
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
        },
    );
};

const confirmDelete = (data) => {
    confirm.require({
        message: `Are you sure you want to delete '${data.name}'?`,
        header: "Danger Zone",
        icon: "pi pi-info-circle",
        rejectProps: { label: "Cancel", severity: "secondary", outlined: true },
        acceptProps: { label: "Delete", severity: "danger" },
        accept: () => {
            router.delete(`/products/${data.id}`, {
                onSuccess: () =>
                    toast.add({
                        severity: "success",
                        summary: "Deleted",
                        detail: `"${data.name}" deleted successfully!`,
                        life: 3000,
                    }),
                onError: () =>
                    toast.add({
                        severity: "error",
                        summary: "Error",
                        detail: "Failed to delete product!",
                        life: 3000,
                    }),
            });
        },
        reject: () =>
            toast.add({
                severity: "warn",
                summary: "Cancelled",
                detail: "Delete cancelled",
                life: 3000,
            }),
    });
};
</script>

<style scoped>
@keyframes card-spin {
    to {
        transform: rotate(360deg);
    }
}
</style>
