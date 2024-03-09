<script setup>
import ElPanel from "@/Components/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ElRouteClients from "@/Components/ElRoutes/ElRouteClients.vue";
import ActionMenu from "@/Components/ActionMenu/ActionMenu.vue";
import ActionMenuEdit from "@/Components/ActionMenu/ActionMenuEdit.vue";
import {Ability} from "@/ability.js";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import SvgTrueFalse from "@/Components/Svg/SvgTrueFalse.vue";
import ActionMenuDeleteAction from "@/Components/ActionMenu/ActionMenuDeleteAction.vue";
import ExportExcelButton from "@/Components/Buttons/ExportExcelButton.vue";

import route from "ziggy-js";
import { getAlignFrozen } from "@/Helpers/Functions.js";

const props = defineProps({
    data: Object,
    form_data: Object,
})
</script>

<template>
    <ElPanel :is-transparent="false">
        <template #actions>
            <ExportExcelButton :ability="Ability.M_CLIENTS_INDEX_EXPORT"/>

        </template>
        <ElDataTable :src="props.data">
            <Column :header="$t('base.name')" :alignFrozen="getAlignFrozen()" frozen>
                <template #body="row">
                    <ElRouteClients :model="row.data" />
                </template>
            </Column>
            
            <Column :header="$t('base.phone')">
                <template #body="row">
                    <span>{{ row.data.phone }}</span>
                </template>
            </Column>
            <Column :header="$t('base.is_active')">
                <template #body="row">
                    <SvgTrueFalse :value="row.data.is_active"/>
                </template>
            </Column>
            <Column field="created_at_text" :header="$t('base.created_at')" />
            <Column :header="$t('base.actions')">
                <template #body="row">
                    <ActionMenu>
                        <ActionMenuEdit :ability="Ability.M_CLIENTS_UPDATE" :href="route('clients.profile.edit', row.data.id)" />
                        <ActionMenuDeleteAction :ability="Ability.M_CLIENTS_DELETE" :dialog-message="row.data.name"
                            :href="route('clients.delete', row.data.id)" />
                    </ActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
</template>

<style scoped></style>
