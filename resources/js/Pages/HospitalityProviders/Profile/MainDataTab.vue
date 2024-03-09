<template>
    <ElContainer>
        <section class="grid grid-cols-2 mt-3 gap-4">
            <div>
                <label>{{ $t('base.name') }} : </label>
                <label class="underline">{{ data.row.name }}</label>
            </div>
            <div>
                <label>{{ $t('base.email') }} : </label>
                <label class="underline">{{ data.row.email }}</label>
            </div>
            <div>
                <label>{{ $t('base.created_at_text') }} : </label>
                <label>{{ data.row.created_at_text }}</label>
            </div>
        </section>
    </ElContainer>

    <ElContainer :title="$t('base.roles')"  v-if="props.data.row?.roles.length" class="mt-2">
        <section>
            <div>
                <label>{{ $t('base.roles') }} : </label>
                <ul class="inline-block">
                    <li v-for="role in props.data.row?.roles" :key="role.id">
                        <AbilityLink :ability="Ability.M_ROLES_UPDATE" :href="route('roles.edit',role.id)">
                            {{ role.name }}
                        </AbilityLink>
                    </li>
                </ul>
            </div>
            <div class="flex mt-3">
                <label>{{ $t('base.permissions') }}:</label>
                <div class="w-full">
                    <ul class="block w-full">
                        <li class="underline font-bold">
                            {{ $t('base.role_permission') }}
                        </li>
                        <li>
                            <main v-for="(items, index) of props.data.current_role_abilities">
                                <section class="border-b border-b-black pb-2 mb-2">
                                    <h1 class="text-xl  underline underline-offset-4">
                                        {{ $t('enums.ModuleNameEnum.' + index) }}</h1>
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                        <div v-for="ability of items" :key="items"
                                             class="field-checkbox text-lg">
                                            <label :for="ability.key"
                                                   class="px-1">{{ $t('abilities.' + ability.key) }}</label>
                                        </div>
                                    </div>
                                </section>
                            </main>
                        </li>
                        <li class="underline font-bold" v-if="props.data.active_custom_abilities?.length">
                            {{ $t('base.custom_permission') }}
                        </li>
                        <li>
                            <main v-for="(items, index) of props.data.active_custom_abilities_module">
                                <section class="border-b border-b-black pb-2 mb-2">
                                    <h1 class="text-xl  underline underline-offset-4">
                                        {{ $t('enums.ModuleNameEnum.' + index) }}</h1>
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                        <div v-for="ability of items" :key="items"
                                             class="field-checkbox text-lg">
                                            <label :for="ability.key" class="px-1">{{ $t('abilities.' + ability.key) }}</label>
                                            <IconDeleteButton v-ability="Ability.M_USERS_ADD_CUSTOM_ABILITY" @click="removePermission(ability.key)"/>
                                        </div>
                                    </div>
                                </section>
                            </main>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <secondary-button :text="$t('base.edit_permission')" class="mt-3"
                          v-if="props.data.row?.roles?.length"
                          v-ability="Ability.M_USERS_ADD_CUSTOM_ABILITY" @click="dialogEdit = true;"/>

    </ElContainer>
    <Dialog v-model:visible="dialogEdit" :style="{width: '900px'}" :header="$t('base.edit_permission')" :modal="true"
            class="p-fluid">
        <template v-for="(items, index) of props.data.custom_abilities">
            <section class="border-b container-ability border-b-black pb-2 mb-2">
                <h1 class="text-xl  underline underline-offset-4">{{ $t('enums.ModuleNameEnum.' + index) }}</h1>
                <aside class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <template v-for="ability of items" :key="items">
                        <div class="field-checkbox text-lg">
                            <LabelCheckbox :id="ability.key+ability.module" :form="form_edit_permission"
                                      name="abilities"
                                      :value="ability.key"
                                      :label="$t('abilities.' + ability.key)"/>
                        </div>
                    </template>
                </aside>
            </section>
        </template>
        <template #footer>
            <secondary-button :text="$t('base.cancel')" @click="dialogEdit = false;"/>
            <submit-button :form="form_edit_permission" :text="$t('base.save')" @click="updatePermission"/>
        </template>
    </Dialog>

</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";
import {Ability} from "@/ability.js";
import AbilityLink from "@/Components/AbilityLink.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import Dialog from "primevue/dialog";
import LabelCheckbox from "@/Components/Form/LabelCheckbox.vue";
import IconDeleteButton from "@/Components/Buttons/IconDeleteButton.vue";

const props = defineProps(['data']);
const form_remove_permission = useForm({
    name: null
});
const form_edit_permission = useForm({
    abilities: props.data?.active_custom_abilities ?? [],
});
const removePermission = (name) => {
    form_remove_permission.name = name
    form_remove_permission.delete(route('users.remove-custom-permission',props.data.row.id), {
        onSuccess: (response) => {
            window.location.reload();
        },
        onError: (error) => console.log(error)
    });
}
const dialogEdit = ref(false);

const updatePermission = () => {
    form_edit_permission.post(route('users.edit-custom-permission',props.data.row.id), {
        onSuccess: () => {
            dialogEdit.value = false;
        },
        onError: (error) => console.log(error)
    }, {
        forceFormData: true,
    });
}
</script>
