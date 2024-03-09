<template>
    <AbilityLink :href="href" :ability="ability">
        <div v-if="$slots.avatar" class="flex space-x-2 space-x-reverse">
            <slot name="avatar"></slot>
            <div class="text-right flex flex-col py-1">
                <div v-if="$slots.title" class="font-bold">
                    <slot name="title"></slot>
                </div>
                <div v-if="$slots.description" class="text-slate-400 text-sm">
                    <slot name="description"></slot>
                </div>
            </div>
        </div>
        <aside v-else class="flex flex-col h-full">
            <div v-if="$slots.title" class="font-bold">
                <slot name="title"></slot>
            </div>
            <div v-if="$slots.description" class="text-slate-400">
                <slot name="description"></slot>
            </div>
        </aside>
    </AbilityLink>
</template>

<script setup>

import AbilityLink from "@/Components/AbilityLink.vue";

const props = defineProps({
    href: {
        type: String,
        default: null,
    },
    ability: {
        type: String,
        default: null,
    },
})
</script>

<style scoped>
.not-link button{
    color: black!important;
}
</style>
