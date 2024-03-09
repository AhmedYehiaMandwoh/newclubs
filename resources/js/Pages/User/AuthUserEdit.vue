<template>
    <ElPanel>
        <form @submit.prevent="submit()">
            <div class="grid gap-4 xl:grid-cols-4 2xl:grid-cols-2">
                <div class="col-span-full w-[150px]">
                    <AvatarInput :form="el_form" :old-image-preview="el_form.avatar_url" name="avatar"/>
                </div>
                <floating-input :form="el_form" required="1" name="name"/>
                <floating-input :form="el_form" required="1" type="email" name="email"/>
                <floating-password :form="el_form" name="password"/>

                <div class="text-center col-span-full">
                    <submit-button :text="$t('base.save')" :form="el_form"/>
                </div>
            </div>
        </form>
    </ElPanel>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import FloatingInput from "@/Components/Form/FloatingInput.vue";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import route from "ziggy-js";
import FloatingPassword from "@/Components/Form/FloatingPassword.vue";
import AvatarInput from "@/Components/Form/AvatarInput.vue";
import ElPanel from "@/Components/ElPanel.vue";

const props = defineProps({
    userDetails: {
        type: Array,
        default: {}
    },
})
const user = props?.userDetails;
const el_form = useForm({
    id: user?.id,
    avatar: null,
    avatar_url: user?.avatar_url ?? null,
    name: user?.name,
    email: user?.email ?? null,
    password: null,
})
const submit = () => {
    el_form.post(route('auth.update'));
}

</script>
