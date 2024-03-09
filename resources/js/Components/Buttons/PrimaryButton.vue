<template>
    <component :is="href ? 'Link' : 'span'" class="self-start bg-primary-500 border border-primary-500 disabled:opacity-80
    cursor-pointer text-white py-2 px-8 inline-block mx-1  dark:text-slate-200 dark:bg-primary-800
     rounded hover:bg-opacity-80 transition-all duration-300 text-base font-bold"
    v-bind="$attrs" :href="href">
        <slot/>
        <span v-if="text" v-text="text"/>
    </component>
</template>

<script setup>
const props = defineProps({
    href: {
        type:String,
        default:null,
    },
    text: String
})
</script>

<style scoped>

</style>
