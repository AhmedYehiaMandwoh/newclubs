<template>
        <ElPanelCreate :is-transparent="false"  v-if="$page.url == '/hospitality_providers/branches/create'"/>

    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-2 mt-2 gap-3 p-4">
            <floating-input required :form="el_form" name="name" />
            <floating-input required  :form="el_form" name="latitude" />
            <floating-input required  :form="el_form" name="longitude" />
            <floating-dropdown v-if="!is_create" :form="el_form" name="is_active" :options="formData.is_active" :label="$t('base.status')" />
            <floating-input required :form="el_form" name="address" />
            <div class="">
                <submit-button :text="$t('base.save')" :form="el_form" />
            </div>
        </div>
    </form>
</template>

<script setup>
import ElPanelCreate from "@/Components/ElPanelCreate.vue";

import { useForm } from "@inertiajs/vue3";
import FloatingInput from "@/Components/Form/FloatingInput.vue";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import route from "ziggy-js";
import FloatingDropdown from "@/Components/Form/FloatingDropdown.vue";

const props = defineProps({
    row: {
        type: Array,
        default: {}
    },
    formData: {
        type: Object,
        default: {}

    },
})
const is_create = !props?.row?.id;
const el_row = props?.row;
const el_form = useForm({
    id: el_row?.id,
    name: el_row?.name ?? null,
    latitude: el_row?.latitude ?? null,
    longitude: el_row?.longitude ?? null,
    address: el_row?.address ?? null,
    is_active: is_create ? true : el_row?.is_active,
})

const submit = () => {
    el_form.post(is_create ? route('hospitality_providers.branches.store') : route('hospitality_providers.branches.update', el_form.id), {
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
}

</script>
