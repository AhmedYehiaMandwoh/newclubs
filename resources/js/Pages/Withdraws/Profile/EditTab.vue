<template>
    <ElContainer>
        <WithdrawFormCreateUpdate :form-data="data.form_data" :row="data.row"/>
    </ElContainer>
</template>

<script setup>
import WithdrawFormCreateUpdate from "@/Pages/Withdraws/WithdrawFormCreateUpdate.vue";
import ElContainer from "@/Components/Card/ElContainer.vue";

const props = defineProps(['data']);
</script>
