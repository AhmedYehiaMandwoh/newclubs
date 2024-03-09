<script setup>
import ElPanelWithoutBread from "@/Components/ElPanelWithoutBread.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ElRouteOffer from "@/Components/ElRoutes/Managment/ElRouteOffer.vue";
import ActionMenu from "@/Components/ActionMenu/ActionMenu.vue";

import ExportExcelButton from "@/Components/Buttons/ExportExcelButton.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import ActionMenuEdit from "@/Components/ActionMenu/ActionMenuEdit.vue";

import SvgTrueFalse from "@/Components/Svg/SvgTrueFalse.vue";

import ActionMenuDeleteAction from "@/Components/ActionMenu/ActionMenuDeleteAction.vue";
import route from "ziggy-js";
import { ref } from "vue";
import { getAlignFrozen } from "@/Helpers/Functions.js";
import Dialog from "primevue/dialog";

const showDialogCreate = ref(false);
const showDialogEdit = ref(false);

const props = defineProps({
    data: Object,
    form_data: Object,
    branch_id: Object,
})
let EditSetting = {};
function showEditSetting(val) {
    EditSetting = val;
    showDialogEdit.value = true
}
import { Ability } from "@/ability";
import OffersFormCreateUpdate from "../OffersFormCreateUpdate.vue";

</script>

<template>
    <ElPanelWithoutBread :is-transparent="false">

        <template #actions>
            <primary-button  :text="$t('base.add_new')" @click="showDialogCreate=true"/>
            <ExportExcelButton />
        </template>
        <ElDataTable :src="props.data">
            <Column :header="$t('base.name')" :alignFrozen="getAlignFrozen()" frozen>
                <template #body="row">
                    <ElRouteOffer :model="row.data" />
                </template>
            </Column>
            <Column field="roles" :header="$t('base.status')">
                <template #body="row">
                    <SvgTrueFalse :value="row.data.is_active" />
                </template>
            </Column>
            <Column :header="$t('base.offer_type')">
                <template #body="row">
                    {{ $t('base.' + row.data.offer_type) }}

                </template>
            </Column>
            <Column :header="$t('base.discount')">
                <template #body="row">
                    {{ row.data.discount }} %
                </template>
            </Column>
            <Column :header="$t('base.show_percent')">
                <template #body="row">
                    {{ row.data.show_percent }} %
                </template>
            </Column>
            <Column :header="$t('base.can_use_type')">
                <template #body="row">
                    {{ $t('base.' + row.data.can_use_type) }}

                </template>
            </Column>
            <Column :header="$t('base.can_use_type_date')">
                <template #body="row">
                    {{ row.data.can_use_type_date }}

                </template>
            </Column>
            <Column :header="$t('base.valid_to_date')">
                <template #body="row">
                    {{ row.data.valid_to_date }}
                </template>
            </Column>
            <Column :header="$t('base.valid_to_type')">
                <template #body="row">
                    {{ $t('base.' + row.data.valid_to_type) }}

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

            <Column field="created_at_text" :header="$t('base.created_at')" />
            <Column :header="$t('base.actions')">
                <template #body="row">
                    <ActionMenu>
                        <ActionMenuEdit  @click="showEditSetting(row.data)" />
                        <ActionMenuDeleteAction :ability="true" :dialog-message="row.data.name"
                            :href="route('hospitality_providers.offers.delete', row.data.id)" />
                    </ActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanelWithoutBread>


    <Dialog v-model:visible="showDialogCreate" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }" :header="$t('base.add_new')" :modal="true"
        class="p-fluid">
        <OffersFormCreateUpdate :row="data" :formData="form_data" :branch_id="branch_id" @success="showDialogCreate = false" />
    </Dialog>
    <Dialog v-model:visible="showDialogEdit" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }" :header="$t('base.add_new')" :modal="true"
        class="p-fluid">
        <OffersFormCreateUpdate :row="EditSetting" :formData="form_data" :branch_id="branch_id" @success="showDialogEdit = false" />
    </Dialog>
</template>

<style scoped></style>
