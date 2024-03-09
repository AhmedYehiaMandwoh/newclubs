<template>
        <BranchFormCreateUpdate :form-data="data.form_data" :row="data.row" />
</template>

<script setup>
import BranchFormCreateUpdate from "@/Pages/HospitalityProviders/Branches/BranchFormCreateUpdate.vue";

const props = defineProps(['data']);
</script>
