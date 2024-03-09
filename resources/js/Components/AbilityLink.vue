<template>
    <template v-if="ability.length && href">
        <Link :href="href" class="text-primary-700 hover:text-primary-500" v-ability="props.ability">
            <slot/>
        </Link>
        <label v-else-ability="ability" class="not-link">
            <slot/>
        </label>
    </template>
    <template v-else>
        <Link :href="href" v-if="href" class="text-primary-700 hover:text-primary-500">
            <slot/>
        </Link>
        <label v-else>
            <slot/>
        </label>
    </template>
</template>

<script setup>
const props = defineProps({
    href: {
        type: String,
        default: null,
    },
    ability: {
        type: String,
        default: "",
    },
})
</script>
<style scoped>

</style>
