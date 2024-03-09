<template>
    <component :is="href ? 'Link' : 'span'"
               class="self-start bg-transparent text-secondary-800 dark:text-slate-200
                border border-secondary-500 dark:border-secondary-300 disabled:opacity-80
     cursor-pointer inline-block py-2 px-8 mx-1
     rounded transition-all duration-300 text-base font-bold
     hover:bg-secondary-500
     hover:text-white dark:hover:text-white"
               v-bind="$attrs" :href="href">
        <slot/>
        <span v-if="text" v-text="text"/>
    </component>
</template>
<script setup>
const props = defineProps({
    href: {
        type: String,
        default: null,
    },
    text: {type: String, default: null},
})
</script>

<style scoped>

</style>
