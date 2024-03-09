<template>
    <button class="bg-primary-500 border border-primary-500 disabled:opacity-90 disabled:cursor-progress text-white py-2 px-8
     rounded hover:bg-opacity-80 !w-auto transition-all duration-300 text-base font-bold  dark:text-slate-200 dark:bg-primary-800"
            type="submit" :disabled="progressing">
        <loading-dots v-if="progressing || form?.processing"/>
        <span v-else v-text="text"/>
    </button>
</template>

<script setup>
import LoadingDots from "@/Components/LoadingDots.vue";

defineProps({
    progressing: {
        type: Boolean,
        default: false
    },
    form: {type: Object, default: {}},
    text: String
})
</script>

<style scoped>

</style>
