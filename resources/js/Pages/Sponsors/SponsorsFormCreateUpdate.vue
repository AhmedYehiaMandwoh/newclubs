<template>
    <ElPanelCreate :is-transparent="false" v-if="$page.url == '/sponsors/create'" />
    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-2 mt-2 gap-3 p-4">
            <div class="col-span-full w-[150px]">
                <AvatarInput :form="el_form" :old-image-preview="el_form.avatar_url" name="avatar" />
            </div>
            <floating-input required :form="el_form" name="name" />
            <floating-dropdown v-if="!is_create" :form="el_form" name="is_active" :required="1"
                :options="formData.is_active" :label="$t('base.is_active')" />
            <div class="">
                <submit-button :text="$t('base.save')" :form="el_form" />
            </div>
        </div>
    </form>
</template>

<script setup>

import { useForm } from "@inertiajs/vue3";
import FloatingInput from "@/Components/Form/FloatingInput.vue";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import route from "ziggy-js";
import AvatarInput from "@/Components/Form/AvatarInput.vue";
import FloatingDropdown from "@/Components/Form/FloatingDropdown.vue";
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
    is_active: is_create ? true : el_row?.is_active,
})

const submit = () => {
    el_form.post(is_create ? route('sponsors.store') : route('sponsors.update', el_form.id), {
        onSuccess: () => {
            is_create && el_form.reset();
            if (is_create) {
                window.location.reload();
            }
        },
    })
}

</script>



