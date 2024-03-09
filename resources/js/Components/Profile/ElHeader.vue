<template>
    <header class="el-container border p-2 rounded-md">
        <section>
            <slot name="header"></slot>
        </section>
        <section v-if="$slots.tabs" class="text-start px-2 rounded mx-auto">
            <ul class="flex flex-wrap -mb-px">
                <slot name="tabs"></slot>
            </ul>
        </section>
    </header>
</template>
<script setup>

</script>
