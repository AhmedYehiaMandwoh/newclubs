<script setup>
import ElPanel from "@/Components/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ElRouteUserProfile from "@/Components/ElRoutes/ElRouteUserProfile.vue";
import ActionMenu from "@/Components/ActionMenu/ActionMenu.vue";
import ActionMenuEdit from "@/Components/ActionMenu/ActionMenuEdit.vue";
import {Ability} from "@/ability.js";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import ActionMenuExportExcel from "@/Components/ActionMenu/ActionMenuExportExcel.vue";
import SvgTrueFalse from "@/Components/Svg/SvgTrueFalse.vue";
import ActionMenuDeleteAction from "@/Components/ActionMenu/ActionMenuDeleteAction.vue";
import route from "ziggy-js";
import {ref} from "vue";
import UserFormCreateUpdate from "@/Pages/User/UserFormCreateUpdate.vue";
import Dialog from "primevue/dialog";
import {getAlignFrozen} from "@/Helpers/Functions.js";
import AbilityLink from "@/Components/AbilityLink.vue";

const props=defineProps({
    data:Object,
    form_data:Object,
})
const showDialogCreate = ref(false);
</script>

<template>
    <ElPanel :is-transparent="false">
        <template #actions>
            <primary-button :href="route('roles.index')" v-ability="Ability.M_ROLES_INDEX" :text="$t('base.roles')"/>
            <secondary-button @click="showDialogCreate=true" v-ability="Ability.M_USERS_STORE" :text="$t('base.add_new')"/>
            <ActionMenu>
                <ActionMenuExportExcel :ability="Ability.M_USERS_INDEX_EXPORT"/>
            </ActionMenu>
        </template>
        <ElDataTable :src="props.data">
            <Column :header="$t('base.name')" :alignFrozen="getAlignFrozen()" frozen class="myStyle">
                <template #body="row">
                    <ElRouteUserProfile :model="row.data"/>
                </template>
            </Column>
            <Column field="roles" :header="$t('base.role')">
                <template #body="row">
                    <AbilityLink v-for="item in row.data.roles" :ability="Ability.M_ROLES_UPDATE" :href="route('roles.edit',item.id)">
                        {{item.name}}
                    </AbilityLink>
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
                        <ActionMenuEdit :ability="Ability.M_USERS_UPDATE" :href="route('users.profile.edit',row.data.id)"/>
                        <ActionMenuDeleteAction :ability="Ability.M_USERS_DELETE" :dialog-message="row.data.name" :href="route('users.delete',row.data.id)"/>
                    </ActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
    <Dialog v-model:visible="showDialogCreate" :style="{width: '500px'}" :header="$t('base.add_new')" :modal="true"
            class="p-fluid">
        <UserFormCreateUpdate :form-data="form_data" @success="showDialogCreate=false"/>
    </Dialog>
</template>

