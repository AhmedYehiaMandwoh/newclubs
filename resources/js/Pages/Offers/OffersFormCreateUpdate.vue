<template>
    <ElPanelCreate :is-transparent="false" v-if="$page.url == '/offers/create'" />

    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-3 mt-2 gap-3 p-3">
            <div class="col-span-full w-[150px]">
                <AvatarInput :form="el_form" :old-image-preview="el_form.icon_url" name="icon" />
            </div>
            <floating-input required :form="el_form" name="name" />
            <floating-dropdown required :form="el_form" name="discount_type" :options="formData.discount_type"
                :label="$t('base.discount_type')" />

            <floating-input min="0" type="number" :form="el_form" required name="discount_percent"
            v-if="el_form.discount_type == 'discount'"
                oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
                <floating-input required :form="el_form" name="show_percent" />
                <floating-dropdown required :form="el_form" name="can_use_type" :options="formData.can_use_type"
                :label="$t('base.can_use_type')" />

                <floating-calendar v-if="el_form.can_use_type == 'in_date'" :form="el_form"  :minDate="!is_create ? new Date(el_form.can_use_from_date) : new Date()"
                name="can_use_from_date"  />

                <floating-dropdown required :form="el_form" name="valid_to_type" :options="formData.valid_to_type"
                :label="$t('base.valid_to_type')" />

                <floating-input min="0" type="number" :form="el_form" required name="max_used"
                    oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                    onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
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
import AvatarInput from "@/Components/Form/AvatarInput.vue";
import FloatingCalendar from "@/Components/Form/FloatingCalendar.vue";

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
console.log(el_row);
const el_form = useForm({
    id: el_row?.id,
    branch_id: null,
    name: el_row?.name ?? null,
    icon: null,
    icon_url: el_row?.icon_url ?? null,
    max_used: el_row?.max_used ?? null,
    discount_percent: el_row?.discount_percent ?? null,
    show_percent: el_row?.show_percent,
    discount_type: el_row?.discount_type,
    can_use_type: el_row?.can_use_type ?? null,
    can_use_from_date: el_row?.can_use_from_date ? formatDate(new Date(el_row?.can_use_from_date)) : null,
    valid_to_type: el_row?.valid_to_type
})
const submit = () => {
    if (el_form.can_use_from_date !== null) {
        el_form.can_use_from_date = formatDate(new Date(el_form.can_use_from_date));
    }

    el_form.post(is_create ? route('offers.store') : route('offers.update', el_form.id), {
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
