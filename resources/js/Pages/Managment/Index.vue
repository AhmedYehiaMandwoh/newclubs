<script setup>
import ElPanel from "@/Components/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ElRouteHospitality from "@/Components/ElRoutes/Managment/ElRouteHospitality.vue";
import ActionMenu from "@/Components/ActionMenu/ActionMenu.vue";
import ActionMenuEdit from "@/Components/ActionMenu/ActionMenuEdit.vue";
import ActionMenuForAll from "@/Components/ActionMenu/ActionMenuForAll.vue";
import {Ability} from "@/ability.js";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import ExportExcelButton from "@/Components/Buttons/ExportExcelButton.vue";
import SvgTrueFalse from "@/Components/Svg/SvgTrueFalse.vue";
import ActionMenuDeleteAction from "@/Components/ActionMenu/ActionMenuDeleteAction.vue";
import route from "ziggy-js";
import {ref} from "vue";
import HospitalityProvidersFormCreateUpdate from "@/Pages/Managment/HospitalityProvidersFormCreateUpdate.vue";
import Dialog from "primevue/dialog";
import {getAlignFrozen} from "@/Helpers/Functions.js";

const props=defineProps({
    data:Object,
    form_data:Object,
})
const showDialogCreate = ref(false);
</script>

<template>
    <ElPanel :is-transparent="false">
        <template #actions>
            <ExportExcelButton :ability="Ability.M_HospitalityProviders_INDEX_EXPORT" />

        </template>
        <ElDataTable :src="props.data">
            <Column :header="$t('base.name')" :alignFrozen="getAlignFrozen()" frozen>
                <template #body="row">
                    <ElRouteHospitality :model="row.data"/>
                </template>
            </Column>
            <Column field="roles" :header="$t('base.is_active')">
                <template #body="row">
                    <SvgTrueFalse :value="row.data.is_active"/>
                </template>
            </Column>
            <Column field="created_at_text" :header="$t('base.created_at')"/>
            <Column :header="$t('base.actions')">
                <template #body="row">
                    <ActionMenu>
                        <ActionMenuEdit :ability="Ability.M_HospitalityProviders_UPDATE" :href="route('hospitalityproviders.profile.edit',row.data.id)" />
                        <ActionMenuDeleteAction :ability="Ability.M_HospitalityProviders_DELETE" :dialog-message="row.data.name" :href="route('users.delete',row.data.id)"/>
                    </ActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
    <Dialog v-model:visible="showDialogCreate" :style="{width: '500px'}" :header="$t('base.add_new')" :modal="true"
            class="p-fluid">
        <HospitalityProvidersFormCreateUpdate :form-data="form_data" @success="showDialogCreate=false"/>
    </Dialog>
</template>

<style scoped>

</style>
