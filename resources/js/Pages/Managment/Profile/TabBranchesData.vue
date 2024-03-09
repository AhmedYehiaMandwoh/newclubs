<script setup>
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ElRouteBranchWithoutLink from "@/Components/ElRoutes/ElRouteBranchWithoutLink.vue";
import SvgTrueFalse from "@/Components/Svg/SvgTrueFalse.vue";
import {ref} from "vue";
import {getAlignFrozen} from "@/Helpers/Functions.js";

const props = defineProps({
    data: Object,
    form_data: Object,
})
</script>

<template>

   <ElDataTable :src="props.data">
            <Column :header="$t('base.name')" :alignFrozen="getAlignFrozen()" frozen>
                <template #body="row">
                    <ElRouteBranchWithoutLink :model="row.data" />
                </template>
            </Column>
            <Column field="roles" :header="$t('base.qrcode_image')">
                <template #body="row">
                    <a :href="row.data.qr_image" download>
                        <img :src="row.data.qr_image" alt="" width="100">
                    </a>
                </template>
            </Column>
            <Column field="roles" :header="$t('base.latitude')">
                <template #body="row">
                    <span>{{ row.data.latitude }}</span>
                </template>
            </Column>
            <Column field="roles" :header="$t('base.longitude')">
                <template #body="row">
                    <span>{{ row.data.longitude }}</span>
                </template>
            </Column>
            <Column field="roles" :header="$t('base.status')">
                <template #body="row">
                    <SvgTrueFalse :value="row.data.is_active" />
                </template>
            </Column>
            <Column field="created_at_text" :header="$t('base.created_at')" />
            <!-- <Column :header="$t('base.actions')">
                <template #body="row">
                    <ActionMenu>
                        <ActionMenuEdit :ability="true" :href="route('hospitality_providers.branches.edit', row.data.id)" />
                        <ActionMenuDeleteAction :ability="true" :dialog-message="row.data.name"
                            :href="route('hospitality_providers.branches.delete', row.data.id)" />
                    </ActionMenu>
                </template>
            </Column> -->
        </ElDataTable>
</template>

<style scoped></style>
