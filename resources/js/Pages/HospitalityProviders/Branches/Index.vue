<script setup>
import ElPanel from "@/Components/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ElRouteBranch from "@/Components/ElRoutes/ElRouteBranch.vue";
import ActionMenu from "@/Components/ActionMenu/ActionMenu.vue";
import ActionMenuEdit from "@/Components/ActionMenu/ActionMenuEdit.vue";
// import {Ability} from "@/ability.js";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import SvgTrueFalse from "@/Components/Svg/SvgTrueFalse.vue";
import ActionMenuDeleteAction from "@/Components/ActionMenu/ActionMenuDeleteAction.vue";
import ExportExcelButton from "@/Components/Buttons/ExportExcelButton.vue";

import route from "ziggy-js";
import { ref } from "vue";
import { getAlignFrozen } from "@/Helpers/Functions.js";

const props = defineProps({
    data: Object,
    form_data: Object,
})
</script>

<template>
    <ElPanel :is-transparent="false">
        <template #actions>
            <primary-button :href="route('hospitality_providers.branches.create')" :text="$t('base.add_new')" />
            <ExportExcelButton  />

        </template>
        <ElDataTable :src="props.data">
            <Column :header="$t('base.name')" :alignFrozen="getAlignFrozen()" frozen>
                <template #body="row">
                    <ElRouteBranch :model="row.data" />
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
            <Column :header="$t('base.actions')">
                <template #body="row">
                    <ActionMenu>
                        <ActionMenuEdit :ability="true" :href="route('hospitality_providers.branches.profile.edit', row.data.id)" />
                        <ActionMenuDeleteAction :ability="true" :dialog-message="row.data.name"
                            :href="route('hospitality_providers.branches.delete', row.data.id)" />
                    </ActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
</template>

<style scoped></style>
