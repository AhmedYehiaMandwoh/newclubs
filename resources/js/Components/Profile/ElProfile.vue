<template>
    <main class="mb-3">
        <section v-if="$slots.header" class="mb-3">
            <slot name="header"/>
        </section>
        <section v-if="$slots.tabContent" class="el-container">
            <slot name="tabContent"></slot>
        </section>
        <section v-if="$slots.tabContentTransparent">
            <slot name="tabContentTransparent"></slot>
        </section>
    </main>
</template>

<script setup>

</script>

<style scoped>

</style>
