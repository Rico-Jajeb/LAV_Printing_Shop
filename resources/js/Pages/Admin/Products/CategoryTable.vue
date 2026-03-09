<template>
    <main class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 ">
        <div class="card">
                <DataTable v-model:filters="filters" v-model:selection="selectedCustomer" :value="customers"
                        stateStorage="session" stateKey="dt-state-demo-session" paginator :rows="5" filterDisplay="menu"
                        selectionMode="single" dataKey="id" :globalFilterFields="['name','description','status']" tableStyle="min-width: 50rem">
                    <template #header>
                        <IconField>
                        <InputIcon>
                            <i class="pi pi-search" />
                        </InputIcon>
                        <InputText v-model="filters['global'].value" placeholder="Global Search" />
                    </IconField>
                    </template>
                    <Column field="name" header="Name" sortable style="width: 25%">
                        <template #filter="{ filterModel }">
                            <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
                        </template>
                    </Column>
                    <Column field="description" header="description" sortable style="width: 25%">
                        <template #filter="{ filterModel }">
                            <InputText v-model="filterModel.value" type="text" placeholder="Search by description" />
                        </template>
                    </Column>
            
                    <Column field="status" header="Status" sortable filterMatchMode="equals" style="width: 25%">
                        <template #body="{ data }">
                            <Tag :value="data.status" :severity="getSeverity(data.status)" />
                        </template>
                        <template #filter="{ filterModel }">
                            <Select v-model="filterModel.value" :options="statuses" placeholder="Select One" showClear>
                                <template #option="slotProps">
                                    <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)" />
                                </template>
                            </Select>
                        </template>
                    </Column>
                    <template #empty> No customers found. </template>
                </DataTable>
        </div>
    </main>

</template>
<script setup>
import { ref, onMounted } from 'vue';
import { FilterMatchMode, FilterOperator } from '@primevue/core/api';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import IconField from 'primevue/iconfield'
import InputIcon from 'primevue/inputicon'
import InputText from 'primevue/inputtext'
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional

const props = defineProps({
    customers: Array
})


const selectedCustomer = ref();
const filters = ref(
    {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
        description: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
        status: { operator: FilterOperator.OR, constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }] }
    }
);


const getSeverity = (status) => {
    switch (status) {
        case 'unqualified':
            return 'danger';

        case 'qualified':
            return 'success';

        case 'new':
            return 'info';

        case 'negotiation':
            return 'warn';

        case 'renewal':
            return null;
    }
};

</script>