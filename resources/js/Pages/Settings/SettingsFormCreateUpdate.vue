<template>
    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-1 gap-3 mt-2">
            <floating-input v-if="row.key!=='terms_and_conditions'" type="number" required :form="el_form" name="value"/>
            <floating-textarea required :form="el_form" name="value" v-else/>

            <div class="">
                <submit-button :text="$t('base.save')" :form="el_form"/>
            </div>
        </div>
    </form>

</template>

<script setup>

import {useForm} from "@inertiajs/vue3";
import FloatingInput from "@/Components/Form/FloatingInput.vue";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import route from "ziggy-js";
import FloatingTextarea from "@/Components/Form/FloatingTextarea.vue";


const props = defineProps({
    row: {
        type: Array,
        default: {}
    },
})
const el_row = props?.row;
const el_form = useForm({
    id: el_row?.id,
    value: el_row?.value ?? null,
})

const submit = () => {
    el_form.post(route('settings.update', el_form.id));
}

</script>
