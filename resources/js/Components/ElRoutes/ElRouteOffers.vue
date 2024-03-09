<template>
    <ElRoute :ability="Ability.M_OFFERS_UPDATE"  :href="route('offers.profile.main-data',model?.id)">
        <template #avatar>
            <Avatar :image="model.icon_url"  v-if="showAvatar"
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
