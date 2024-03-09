<template>
    <secondary-button v-ability="ability" @click="exportExcel()" v-text="$t('base.export_excel')"/>
</template>
<script setup>
import {exportExcel} from "@/Helpers/Functions";
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
const props = defineProps({
    ability: {type: String, default: null}
})
</script>

<style scoped>

</style>
