<template>
    <ElRoute :ability="true" :href="route('hospitality_providers.branches.profile.main-data',model?.id)">
       
        <template #title> {{ model.name }}</template>

    </ElRoute>
</template>

<script setup>
import {Ability} from "@/ability";
import ElRoute from "@/Components/ElRoutes/ElRoute.vue";

const props = defineProps({
    model: {type: Object, default: null},
})
</script>


<style scoped>

</style>
