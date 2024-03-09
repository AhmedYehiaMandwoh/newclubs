<script setup>
import Dropdown from 'primevue/dropdown';

import {ref} from 'vue';
import {usePage} from "@inertiajs/vue3";
import {collect} from "collect.js";

const props_locals = usePage().props.locals;
const selected_lang = ref(usePage().props.locale);
const changeLang = () => {
    window.location.href = collect(props_locals).where('id', selected_lang.value).first().url;
}
</script>

<template>
    <Dropdown v-model="selected_lang" :options="props_locals" @change="changeLang" optionLabel="name"
              class="h-[42px]"
              option-value="id"/>
</template>

<style scoped>

</style>
