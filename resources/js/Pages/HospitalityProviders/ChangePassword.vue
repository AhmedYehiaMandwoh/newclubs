<script setup>
import {useForm} from "@inertiajs/vue3";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import FloatingPassword from "@/Components/Form/FloatingPassword.vue";
import FloatingInput from "@/Components/Form/FloatingInput.vue";

import ChangeLang from "@/Components/ChangeLang.vue";

const props = defineProps({
    reset: {
        type: Array,
        default: {}
    },
})
const reset = props?.reset;
const el_form = useForm({
    token: reset.token,
    password: '',
    password_confirmation: '',
});
const submit = () => {
    el_form.post(route('hospitality_providers.changePassword'), {
        onSuccess: () => {
            el_form.reset();
        },
    })
};


</script>

<template>
    <main class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <img class="w-[100px] h-[100px]" src="/images/logo.jpg" alt="logo"/>
        </div>
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form @submit.prevent="submit">
                <div class="flex flex-col gap-5 mt-3">
                    <floating-password required :form="el_form" name="password"/>
                    <floating-password required :form="el_form" name="password_confirmation"/>
                </div>
              
                <div class="flex items-center justify-between mt-4">
                    <ChangeLang/>
                    <SubmitButton :text="$t('base.submit')" :form="el_form"/>
                </div>
            </form>
        </div>
    </main>
</template>

<style scoped>

</style>
