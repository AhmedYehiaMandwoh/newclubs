<script setup>
import FloatingInput from "@/Components/Form/FloatingInput.vue";
import {useForm} from "@inertiajs/vue3";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import FloatingPassword from "@/Components/Form/FloatingPassword.vue";
import ChangeLang from "@/Components/ChangeLang.vue";

const el_form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    el_form.post(route('login'));
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
                    <floating-input :form="el_form" name="email"/>
                    <floating-password :form="el_form" name="password"/>
                </div>
                <div class="block mt-4">
                    <label class="flex items-center">
                        <input type="checkbox"
                               v-model='el_form.remember'
                               class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                               name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ $t('base.remember_me') }}</span>
                    </label>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <ChangeLang/>
                    <SubmitButton :text="$t('base.login')" :form="el_form"/>
                </div>
            </form>
        </div>
    </main>
</template>

<style scoped>

</style>
