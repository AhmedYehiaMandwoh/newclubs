<template>
    <ElPanelCreate :is-transparent="false" v-if="$page.url == '/withdraws/create'" />
    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-2 mt-2 gap-3 p-4">
            <div class="col-span-full w-[150px]">
                <AvatarInput :form="el_form" :old-image-preview="el_form.avatar_url" name="avatar" />
            </div>
            <floating-input required :form="el_form" name="name" />
            <floating-calendar required :form="el_form" :minDate="!is_create ? new Date(el_form.started_at) : new Date()"
                name="started_at" :maxDate="!is_create ? new Date(el_form.ended_at) : null" />
            <floating-calendar required :form="el_form" :minDate="new Date(el_form.started_at)" name="ended_at" />

            <div class="">
                <submit-button :text="$t('base.save')" :form="el_form" />
            </div>
        </div>
    </form>
</template>

<script setup>

import { useForm } from "@inertiajs/vue3";
import FloatingInput from "@/Components/Form/FloatingInput.vue";
import FloatingCalendar from "@/Components/Form/FloatingCalendar.vue";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import route from "ziggy-js";
import AvatarInput from "@/Components/Form/AvatarInput.vue";
import ElPanelCreate from "@/Components/ElPanelCreate.vue";

const props = defineProps({
    row: {
        type: Array,
        default: {}
    },
    formData: {
        type: Object,
        default: {}
    }
})

const is_create = !props?.row?.id;
const el_row = props?.row;
const el_form = useForm({
    id: el_row?.id,
    avatar: null,
    avatar_url: el_row?.avatar_url ?? null,
    name: el_row?.name ?? null,
    started_at: el_row?.started_at ?? null,
    ended_at: el_row?.ended_at ?? null,
})

const submit = () => {

    if(el_form.started_at !== null) {
        el_form.started_at =  formatDate(new Date(el_form.started_at));
    }
    if(el_form.ended_at !== null) {
        el_form.ended_at = formatDate(new Date(el_form.ended_at));
    }
    el_form.post(is_create ? route('withdraws.store') : route('withdraws.update', el_form.id), {
        onSuccess: () => {
            is_create && el_form.reset();
            if (is_create) {
                window.location.reload();
            }
        },
    })
}

function formatDate(date = new Date()) {
    const year = date.toLocaleString('default', { year: 'numeric' });
    const month = date.toLocaleString('default', {
        month: '2-digit',
    });
    const day = date.toLocaleString('default', { day: '2-digit' });

    return [year, month, day].join('-');
}

</script>
