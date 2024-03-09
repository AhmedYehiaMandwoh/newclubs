<template>
    <ElContainer>
        <OffersFormCreateUpdate :form-data="data.form_data" :row="data.row"/>
    </ElContainer>
</template>

<script setup>
import OffersFormCreateUpdate from "@/Pages/Offers/OffersFormCreateUpdate.vue";
import ElContainer from "@/Components/Card/ElContainer.vue";

const props = defineProps(['data']);
</script>
