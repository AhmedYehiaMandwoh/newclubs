<template>
    <ActionMenuItem :href="href" v-ability="ability" icon="pi pi-building" :text="$t('base.'+ title)"/>
</template>

<script setup>
import ActionMenuItem from "@/Components/ActionMenu/ActionMenuItem.vue";

const props = defineProps({
    ability: null,
    href: null,
    title: null,
})
</script>
<style scoped>

</style>
