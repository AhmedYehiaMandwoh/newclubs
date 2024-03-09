<template>
    <section
        class="flex relative flex-col min-w-0 leading-5 break-words bg-clip-border bg-white dark:bg-dark-300 border-0 border-gray-100 border-solid box-border
         text-slate-900 dark:text-white p-2 rounded-md shadow">
        <header class="flex flex-col justify-center my-2 mr-0
                text-xl font-medium break-words box-border text-slate-900 dark:text-primary-100 h-fit">
            <div class="flex flex-row my-0 mr-0 font-medium leading-5 box-border">
                <label class="grow pl-3">
                    {{ title }}
                </label>
                <slot name="actions" class="flex-none"/>
            </div>
        </header>
        <hr>
        <div class="h-fit p-0 lg:p-3">
            <slot/>
        </div>
    </section>
</template>

<script setup>
const props=defineProps(['title']);
</script>

<style scoped>

</style>
