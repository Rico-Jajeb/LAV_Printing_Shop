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
                    <Column
                    field="image"
                    header="Image"
                    style="width: 25%"
                >
                    <template #body="{ data }">
                        <Image 
                            v-if="data.image_url" 
                            :src="data.image_url" 
                            :alt="data.name"
                            width="50"
                           style="height: 50px;object-fit: cover; border-radius: 4px; "
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
                        <Tag
                            :value="data.status"
                            :severity="getSeverity(data.status)"
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
import Image from 'primevue/image';

const props = defineProps({
    category: Array,
});

const selectedCategory = ref();

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
</script>
