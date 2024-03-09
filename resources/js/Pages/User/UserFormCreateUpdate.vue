<template>
    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-2 mt-2 gap-3">
            <div class="col-span-full w-[150px]">
                <AvatarInput :form="el_form" :old-image-preview="el_form.avatar_url" name="avatar" />
            </div>
            <floating-input :form="el_form" required="1" name="name" />
            <floating-input :form="el_form" required="1" type="email" name="email" />
            <floating-password :form="el_form" :required="is_create" name="password" />
            <floating-dropdown :form="el_form" name="role" :required="1" option-value="name" :options="formData.roles"
                :label="$t('base.role')" />
            <floating-dropdown v-if="!is_create" :form="el_form" name="is_active" :required="1"
                :options="formData.is_active" :label="$t('base.is_active')" />
        </div>

        <div class="text-center box-border mt-3">
            <submit-button :text="$t('base.save')" :form="el_form" />
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import FloatingInput from "@/Components/Form/FloatingInput.vue";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import route from "ziggy-js";
import FloatingPassword from "@/Components/Form/FloatingPassword.vue";
import FloatingDropdown from "@/Components/Form/FloatingDropdown.vue";
import AvatarInput from "@/Components/Form/AvatarInput.vue";

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
    avatar: null,
    avatar_url: el_row?.avatar_url ?? null,
    name: el_row?.name,
    email: el_row?.email ?? null,
    password: null,
    role: el_row?.role_name ?? null,
    is_active: is_create ? true : el_row?.is_active,
})
const submit = () => {
    el_form.post(is_create ? route('users.store') : route('users.update', el_form.id), {
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
}

</script>
