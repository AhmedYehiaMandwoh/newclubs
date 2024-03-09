<script setup>
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ActionMenu from "@/Components/ActionMenu/ActionMenu.vue";
import ActionMenuEdit from "@/Components/ActionMenu/ActionMenuEdit.vue";
import {Ability} from "@/ability.js";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import ActionMenuDeleteAction from "@/Components/ActionMenu/ActionMenuDeleteAction.vue";
import route from "ziggy-js";
import ExportExcelButton from "@/Components/Buttons/ExportExcelButton.vue";
import AbilityLink from "@/Components/AbilityLink.vue";

const props=defineProps({
    data:Object,
});

</script>

<template>
    <ElPanel :is-transparent="false">
        <template #actions>
            <primary-button :href="route('roles.create')" v-ability="Ability.M_ROLES_STORE" :text="$t('base.add_new')"/>
            <export-excel-button :ability="Ability.M_ROLES_EXPORT" title="secondary"/>
        </template>
        <ElDataTable :src="props.data">
            <Column :header="$t('base.name')" field="name">
                <template #body="row">
                    <AbilityLink :ability="Ability.M_ROLES_UPDATE" :href="route('roles.edit',row.data.id)">
                        {{row.data.name}}
                    </AbilityLink>
                </template>
            </Column>
            <Column :header="$t('base.users_count')" field="users_count"/>
            <Column :header="$t('base.abilities_count')" field="abilities_count"/>
            <Column field="created_at_text" :header="$t('base.created_at')"/>
            <Column :header="$t('base.actions')">
                <template #body="row">
                    <ActionMenu>
                        <ActionMenuEdit :href="route('roles.edit',row.data.id)" :ability="Ability.M_ROLES_UPDATE"/>
                        <ActionMenuDeleteAction v-if="!row.data.users_count" :ability="Ability.M_ROLES_DELETE" :dialog-message="row.data.name" :href="route('roles.delete',row.data.id)"/>
                    </ActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
</template>

<style scoped>

</style>
