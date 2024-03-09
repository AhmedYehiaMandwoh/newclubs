<template>
    <ActionMenuItem :href="href" v-ability="ability" icon="pi pi-trash" :text="$t('base.delete')"/>
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
