<template>
    <ActionMenuItem :href="href" v-ability="ability" icon="pi pi-pencil" :text="$t('base.edit')"/>
</template>

<script setup>
import ActionMenuItem from "@/Components/ActionMenu/ActionMenuItem.vue";

const props = defineProps({
    ability: null,
    href: null,
})
</script>
<style scoped>

</style>
