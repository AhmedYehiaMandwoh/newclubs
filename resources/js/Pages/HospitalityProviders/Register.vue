<script setup>
import FloatingInput from "@/Components/Form/FloatingInput.vue";
import { useForm } from "@inertiajs/vue3";
import SubmitButton from "@/Components/Buttons/SubmitButton.vue";
import FloatingPassword from "@/Components/Form/FloatingPassword.vue";
import ChangeLang from "@/Components/ChangeLang.vue";
import AvatarInput from "@/Components/Form/AvatarInput.vue";
import route from "ziggy-js";
import FloatingDropdown from "@/Components/Form/FloatingDropdown.vue";

const props = defineProps({

    types: {
        type: Object,
    }
})
const el_form = useForm({
    name: '',
    email: '',
    phone: '',
    type: '',
    password: '',
    password_confirmation: '',
    avatar: null,
    avatar_url: '/images/register-image.png',
});

const submit = () => {
    el_form.post(route('hospitality_providers.storeHospitalityProviders'), {
        onSuccess: () => {
            el_form.reset();
        },
    })
};
</script>

<template>
    <main class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <img class="w-[100px] h-[100px]" src="/images/logo.jpg" alt="logo" />
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form @submit.prevent="submit">
                <div class="flex flex-col gap-5">
                    <div class="col-span-full text-center">
                        <h2 class="mt-6 text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ $t('base.registerAsHospitalityProviders') }}
                        </h2>

                    </div>
                    <div class="col-span-full w-[100px]">
                        <AvatarInput :form="el_form" :old-image-preview="el_form.avatar_url" name="avatar" />
                    </div>
                    <floating-input required :form="el_form" name="name" />
                    <floating-input required type="number" :form="el_form" name="phone" />
                    <floating-input required :form="el_form" name="email" />
                    <floating-password required :form="el_form" name="password" />
                    <floating-password required :form="el_form" name="password_confirmation" />
                    <floating-dropdown required :form="el_form" name="type" :options="types" :label="$t('base.type')" />
                    <div class="flex justify-between">
                        <div>
                            <label for="">{{ $t('base.main_color') }}</label><br>
                            <input type="color" name="main_color">
                        </div>
                        <div>
                            <label for="">{{ $t('base.secondary_color') }}</label><br>
                            <input type="color" class="secondary_color">
                        </div>
                        <div>
                            <label for="">{{ $t('base.third_color') }}</label><br>
                            <input type="color" name="third_color">
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-center justify-between">

                    <div class="flex items-center justify-center text-xs">
                        {{ $t('base.loginToAccount') }}
                        <Link :href="route('hospitality_providers.HospitalityProvidersLogin')"
                            class="ms-2 text-xs text-gray-600 dark:text-gray-400">
                        {{ $t('base.login') }}
                        </Link>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <ChangeLang />
                    <SubmitButton :text="$t('base.create_account')" :form="el_form" />
                </div>

            </form>
        </div>
    </main>
</template>

<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
}
</style>
