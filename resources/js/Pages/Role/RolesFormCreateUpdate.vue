<template>
    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-2 gap-4">
            <floating-input :form="el_form" required="1" name="name"/>
        </div>
        <h1 class="text-2xl underline underline-offset-4 my-3">{{ $t('base.abilities') }}</h1>
        <main class="grid grid-cols-3 gap-3">
            <template v-for="(items, index) of formData.abilities">
                <ElCardWithTitle class="max-h-[350px] overflow-x-auto"
                                 :title="$t('enums.ModuleNameEnum.' + index)">
                    <template #actions>
                        <template v-if="(items.map((x)=>x.key)).every(elem => ((el_form.abilities)).includes(elem))">
                            <secondary-button @click="toggleSelect(index, items,0);" class="!p-1"
                                              :text="$t('base.un_select_all')"/>
                        </template>
                        <template v-else>
                            <secondary-button @click="toggleSelect(index, items,1);" class="!p-1"
                                              :text="$t('base.select_all')"/>
                        </template>
                    </template>
                    <aside class="grid md:grid-cols-2 gap-2">
                        <template v-for="ability of items" :key="items">
                            <template
                                v-if="$page.props.ignored_department_abilities==null || !$page.props.ignored_department_abilities.includes(ability.key)">
                                <div class="field-checkbox text-lg">
                                    <LabelCheckbox :id="ability.key" :form="el_form" name="abilities"
                                                   :value="ability.key"
                                                   :label="$t('abilities.' + ability.key)"/>
                                </div>
                            </template>
                        </template>
                    </aside>
                </ElCardWithTitle>
            </template>
        </main>


        <div class="text-center box-border my-3">
            <submit-button :text="$t('base.save')" :form="el_form"/>
        </div>
    </form>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import FloatingInput from "@/Components/Form/FloatingInput.vue";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import ElCardWithTitle from "@/Components/Card/ElCardWithTitle.vue";
import LabelCheckbox from "@/Components/Form/LabelCheckbox.vue";
import route from "ziggy-js";

const props = defineProps({
    row: {
        type: Array,
        default: {}
    },
    formData: {
        type: Object,
    }
})
const is_create = !props?.row?.id;
const el_row = props?.row;
const el_form = useForm({
    id: el_row?.id,
    name: el_row?.name,
    abilities: el_row?.abilities_name ?? [],
})
const submit = () => {
    if (is_create) {
        el_form.post(route('roles.store'), {
            onSuccess: () => {
                is_create && el_form.reset();
            },
        })
    } else {
        el_form.put(route('roles.update', props.row.id), {
            onSuccess: () => {
            },
        })
    }
}
const toggleSelect = (module, abilities, state = 0) => {
    for (const item_key in abilities) {
        if (state) {
            let index = el_form.abilities.indexOf(abilities[item_key].key);
            if (index === -1) {
                el_form.abilities.push(abilities[item_key].key);
            }
        } else {
            const index = el_form.abilities.indexOf(abilities[item_key].key);
            el_form.abilities.splice(index, 1);
        }
    }
}

</script>
