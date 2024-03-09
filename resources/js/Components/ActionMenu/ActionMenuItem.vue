<template>
    <component :is="$attrs.href?(initA?'a':'Link'):'label'" class="text-gray-700 dark:text-primary-100 block">
        <Button :label="text" :icon="icon" class="p-button-text p-button-plain w-full"/>
    </component>
</template>

<script setup>
import Button from "primevue/button";

const props = defineProps({
    text: null,
    icon: null,
    initA: {type: Boolean, default: false}
})
</script>
<style scoped>

</style>
