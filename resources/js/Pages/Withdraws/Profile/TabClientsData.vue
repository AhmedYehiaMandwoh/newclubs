<script setup>
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ElRouteClients from "@/Components/ElRoutes/ElRouteClients.vue";
import ElRouteDashboardOffer from "@/Components/ElRoutes/ElRouteDashboardOffer.vue";

import { getAlignFrozen } from "@/Helpers/Functions.js";

const props = defineProps({
    data: Object,
    form_data: Object,
})
console.log(props.data);
</script>

<template>
     <ElDataTable :src="props.data">
            <Column :header="$t('base.name')" :alignFrozen="getAlignFrozen()" frozen>
                <template #body="row">
                    <ElRouteClients :model="row.data.user"/>
                </template>
            </Column>
            <Column field="roles" :header="$t('base.offer')">
                <template #body="row">
                    <ElRouteDashboardOffer :model="row.data.offer"/>
                </template>
            </Column>
            <Column field="roles" :header="$t('base.started_at')">
                <template #body="row">
                    {{ row.data.offer.started_at }}
                </template>
            </Column>
            <Column field="roles" :header="$t('base.ended_at')">
                <template #body="row">
                    {{ row.data.offer.ended_at }}
                </template>
            </Column>
            <Column field="roles" :header="$t('base.status')">
                <template #body="row">
                    {{ row.data.offer.status }}
                </template>
            </Column>
            <Column field="roles" :header="$t('base.max_used')">
                <template #body="row">
                    {{ row.data.offer.max_used }}
                </template>
            </Column>
            <Column field="roles" :header="$t('base.count_used')">
                <template #body="row">
                    {{ row.data.offer.count_used }}
                </template>
            </Column>


            <!-- <Column field="created_at_text" :header="$t('base.created_at')"/> -->
        </ElDataTable>
</template>

<style scoped></style>
