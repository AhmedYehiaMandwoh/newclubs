<template>
    <ElPanel :is-transparent="1">
        <RolesFormCreateUpdate :form-data="props.form_data" :row="props.row"/>
    </ElPanel>
</template>

<script setup>
import RolesFormCreateUpdate from "@/Pages/Role/RolesFormCreateUpdate.vue";

const props=defineProps({
    'form_data':{type:Object},
    'row':{type:Object},
})
</script>

<style scoped>

</style>
