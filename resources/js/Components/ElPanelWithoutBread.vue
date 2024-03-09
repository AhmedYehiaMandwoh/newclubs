<template>
    <main class="">
        <header class="flex justify-between mb-2">
            <div>

            </div>
            <div class="flex justify-start self-end">
                <slot name="actions"/>
            </div>
        </header>
        <div :class="{'el-container rounded-md p-2':!isTransparent}">
            <slot/>
        </div>
    </main>
</template>

<script setup>
import Breadcrumb from "primevue/breadcrumb";

const props = defineProps({
    isTransparent: false,
})
</script>


<style scoped>

</style>
