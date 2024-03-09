<template>
    <ElPanel :is-transparent="1">

        <form @submit.prevent="submit()">
            <div class="images">
                <div class="col-span-full w-[150px]">
                    <AvatarInput :form="el_form" :old-image-preview="el_form.avatar_url" name="avatar"/>

                </div>

            </div>
            <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-2">

                <floating-input :form="el_form" required="1" name="name"/>
                <floating-input :form="el_form" required="1" type="email" name="email"/>
                <floating-password :form="el_form" name="password"/>

                <div class="col-span-2">
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
    data: {
        type: Array,
        default: {}
    },
})
const user = props?.data.userDetails;
console.log(props.data);
const el_form = useForm({
    id: user?.id,
    avatar: null,
    avatar_url: user?.avatar_url ?? null,
    name: user?.name,
    email: user?.email ?? null,
    password: null,
})
const submit = () => {
    el_form.post(route('hospitality_providers.profile.update'));
}

</script>
<style>

.images {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
}
</style>
