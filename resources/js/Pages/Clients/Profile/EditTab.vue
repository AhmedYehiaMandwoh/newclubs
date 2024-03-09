<template>
    <ElContainer>
        <ClientFormCreateUpdate :form-data="data.form_data" :row="data.row"/>
    </ElContainer>
</template>

<script setup>
import ClientFormCreateUpdate from "@/Pages/Clients/ClientFormCreateUpdate.vue";
import ElContainer from "@/Components/Card/ElContainer.vue";

const props = defineProps(['data']);
</script>
