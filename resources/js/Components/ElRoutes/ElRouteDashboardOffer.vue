<template>
    <ElRoute :ability="true" >
        <template #avatar>
            <Avatar :image="model.avatar_url"  v-if="showAvatar"
                    class="shadow  shadow-5xl ml-3" size="large"/>
        </template>
        <template #title> {{ model.name }}</template>

    </ElRoute>
</template>

<script setup>
import {Ability} from "@/ability";
import Avatar from 'primevue/avatar';
import ElRoute from "@/Components/ElRoutes/ElRoute.vue";

const props = defineProps({
    model: {type: Object, default: null},
    showAvatar: {type: Boolean, default: true},
})
</script>


<style scoped>

</style>
