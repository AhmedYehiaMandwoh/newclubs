<template>
        <UserFormCreateUpdate :form-data="data.form_data" :row="data.row"/>
</template>

<script setup>
import UserFormCreateUpdate from "@/Pages/User/UserFormCreateUpdate.vue";

const props = defineProps(['data']);
</script>
