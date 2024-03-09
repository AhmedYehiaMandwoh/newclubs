<script setup>
import ElPanel from "@/Components/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ElRouteWithdraws from "@/Components/ElRoutes/ElRouteWithdraws.vue";
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
            <primary-button :ability="Ability.M_WITHDRAWS_CREATE" :href="route('withdraws.create')" :text="$t('base.add_new')" />
            <ExportExcelButton :ability="Ability.M_WITHDRAWS_INDEX_EXPORT"/>

        </template>
        <ElDataTable :src="props.data">
            <Column :header="$t('base.name')" :alignFrozen="getAlignFrozen()" frozen>
                <template #body="row">
                    <ElRouteWithdraws :model="row.data" />
                </template>
            </Column>
            
            <Column :header="$t('base.started_at')">
                <template #body="row">
                    <span>{{ row.data.started_at }}</span>
                </template>
            </Column>
            <Column :header="$t('base.ended_at')">
                <template #body="row">
                    <span>{{ row.data.ended_at }}</span>
                </template>
            </Column>
            <Column field="created_at_text" :header="$t('base.created_at')" />
            <Column :header="$t('base.actions')">
                <template #body="row">
                    <ActionMenu>
                        <ActionMenuEdit :ability="Ability.M_WITHDRAWS_UPDATE" :href="route('withdraws.profile.edit', row.data.id)" />
                        <ActionMenuDeleteAction :ability="Ability.M_WITHDRAWS_DELETE" :dialog-message="row.data.name"
                            :href="route('withdraws.delete', row.data.id)" />
                    </ActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
</template>

<style scoped></style>
