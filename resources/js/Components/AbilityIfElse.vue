<template>
    <section>
        <aside v-ability="props.ability">
            <slot name="if-ability"/>
        </aside>
        <aside v-else-ability="ability">
            <slot name="else-ability"/>
        </aside>
    </section>
</template>

<script setup>
const props = defineProps({
    ability: {
        type: String,
        default: null,
    },
})
</script>
<style scoped>

</style>
