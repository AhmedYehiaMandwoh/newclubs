<script setup>
import Avatar from 'primevue/avatar';
const props=defineProps({
    url:{type:String,default:null},
    label:{type:String,default:null},
})
</script>

<template>
    <Avatar :image="url" :label="!url ? label.charAt(0).toUpperCase() : null" class="shadow h-full shadow-5xl ml-3 !w-[150px] !h-[150px]" size="xlarge"/>
</template>

<style scoped>

</style>
