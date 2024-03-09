<template>
    <Button v-ability="ability" :label="$t('base.export_excel')" icon="pi pi-upload" @click="exportExcel()"
            class="p-button-text p-button-plain dark:text-primary-100 w-full" v-bind="$attrs"/>
</template>

<script setup>
import Button from "primevue/button";
import {exportExcel} from "@/Helpers/Functions";

const props = defineProps({
    ability: {type: String, default: null}
})
</script>
<style scoped>

</style>
