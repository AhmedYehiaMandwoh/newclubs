<template>
    <ElContainer>
        <SponsorsFormCreateUpdate :form-data="data.form_data" :row="data.row"/>
    </ElContainer>
</template>

<script setup>
import SponsorsFormCreateUpdate from "@/Pages/Sponsors/SponsorsFormCreateUpdate.vue";
import ElContainer from "@/Components/Card/ElContainer.vue";

const props = defineProps(['data']);
</script>
