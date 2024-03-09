<template>
    <span v-if="$slots.default">
        <slot/>
    </span>
    <span class="text-base font-bold" v-else>{{ value == null || (value == '' && value != '0') ||(value == '' && zeroToNull) ? '----' : value }}</span>
</template>

<script setup>
const props = defineProps({
    value: {type: String, default: null},
    zeroToNull: {type: Boolean, default: true}
})
</script>


<style scoped>

</style>
