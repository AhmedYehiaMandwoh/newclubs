<template>
    <ElContainer>
        <HospitalityProvidersFormCreateUpdate :form-data="data.form_data" :row="data.row"/>
    </ElContainer>
</template>

<script setup>
import HospitalityProvidersFormCreateUpdate from "@/Pages/Managment/HospitalityProvidersFormCreateUpdate.vue";
import ElContainer from "@/Components/Card/ElContainer.vue";

const props = defineProps(['data']);
</script>
