<script setup>
import ElPanel from "@/Components/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ActionMenu from "@/Components/ActionMenu/ActionMenu.vue";
import ActionMenuEdit from "@/Components/ActionMenu/ActionMenuEdit.vue";
import {Ability} from "@/ability.js";
import Dialog from "primevue/dialog";
import SettingsFormCreateUpdate from "@/Pages/Settings/SettingsFormCreateUpdate.vue";
import {ref} from "vue";

const showDialogCreate = ref(false);

const props = defineProps({
    data: Object,
    form_data: Object,
})

const edit_row = ref({});
function showEditSetting(val) {
    edit_row.value = val;
    showDialogCreate.value = true
}
</script>

<template>
    <ElPanel :is-transparent="false">

        <ElDataTable :src="props.data">
            <Column :header="$t('base.key')" field="key_text"/>
            <Column :header="$t('base.value')">
                <template #body="row">
                   <b>{{ row.data.value }}</b>
                </template>
            </Column>

            <Column field="updated_at_text" :header="$t('base.updated_at_text')"/>
            <Column :header="$t('base.actions')">
                <template #body="row">
                    <ActionMenu>
                        <ActionMenuEdit :ability="Ability.M_SETTINGS_UPDATE"  @click="showEditSetting(row.data)" />
                    </ActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>

    <Dialog v-model:visible="showDialogCreate" :style="{width: '500px'}" :header="$t('base.edit')+' - ' + edit_row?.key_text" :modal="true" class="p-fluid">
        <SettingsFormCreateUpdate :row="edit_row"  @success="showDialogCreate=false"/>
    </Dialog>
</template>

