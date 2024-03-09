<script setup>
import ElPanel from "@/Components/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ElRouteOffers from "@/Components/ElRoutes/ElRouteOffers.vue";
import ActionMenu from "@/Components/ActionMenu/ActionMenu.vue";
import ActionMenuEdit from "@/Components/ActionMenu/ActionMenuEdit.vue";
import {Ability} from "@/ability.js";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import ActionMenuDeleteAction from "@/Components/ActionMenu/ActionMenuDeleteAction.vue";
import ExportExcelButton from "@/Components/Buttons/ExportExcelButton.vue";
import SvgTrueFalse from "@/Components/Svg/SvgTrueFalse.vue";

import route from "ziggy-js";
import { getAlignFrozen } from "@/Helpers/Functions.js";

const props = defineProps({
    data: Object,
    form_data: Object,
})
console.log(props.data);
</script>

<template>
    <ElPanel :is-transparent="false">
        <template #actions>
            <primary-button :ability="Ability.M_OFFERS_CREATE" :href="route('offers.create')" :text="$t('base.add_new')" />
            <ExportExcelButton :ability="Ability.M_OFFERS_INDEX_EXPORT"/>

        </template>
        <ElDataTable :src="props.data">
             <Column :header="$t('base.name')" :alignFrozen="getAlignFrozen()" frozen>
                <template #body="row">
                    <ElRouteOffers :model="row.data" />
                </template>
            </Column>

            <Column :header="$t('base.discount_type')">
                <template #body="row">
                    {{ row.data.discount_type_text }}

                </template>
            </Column>
            <Column :header="$t('base.discount_percent')">
                <template #body="row">
                    {{ row.data.discount_percent }} %
                </template>
            </Column>
            <Column :header="$t('base.show_percent')">
                <template #body="row">
                    {{ row.data.show_percent }} %
                </template>
            </Column>
            <Column :header="$t('base.can_use_type')">
                <template #body="row">
                    {{ row.data.can_use_type_text }}

                </template>
            </Column>
            <Column :header="$t('base.can_use_from_date')">
                <template #body="row">
                    {{ row.data.can_use_from_date }}

                </template>
            </Column>

            <Column :header="$t('base.valid_to_type')">
                <template #body="row">
                    {{ row.data.valid_to_type_text }}

                </template>
            </Column>
            <Column :header="$t('base.valid_to_date')">
                <template #body="row">
                    {{ row.data.valid_to_date }}
                </template>
            </Column>

            <Column :header="$t('base.max_used')">
                <template #body="row">
                    {{ row.data.max_used }}
                </template>
            </Column>
            <Column :header="$t('base.count_used')">
                <template #body="row">
                    {{ row.data.count_used }}
                </template>
            </Column>
            <Column field="created_at_text" :header="$t('base.created_at')"/>
            <Column :header="$t('base.actions')">
                <template #body="row">
                    <ActionMenu>
                        <ActionMenuEdit :ability="Ability.M_OFFERS_UPDATE" :href="route('offers.profile.edit', row.data.id)" />
                        <ActionMenuDeleteAction :ability="Ability.M_OFFERS_DELETE" :dialog-message="row.data.name"
                            :href="route('offers.delete', row.data.id)" />
                    </ActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
</template>

<style scoped></style>
