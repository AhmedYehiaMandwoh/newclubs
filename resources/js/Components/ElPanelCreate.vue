<template>
    <main class="p-4 pb-0">
        <header class="flex justify-between mb-2">
            <div>
                <Breadcrumb v-if="$page.props.breadcrumb?.length" class="bg-transparent dark:text-white mb-3 border-0 text-base p-0"
                            :model="$page.props.breadcrumb">
                    <template #item="{item}">
                        <Link :href="item.url" v-if="item.ability" v-ability="item.ability"
                              class="p-menuitem-link text-right"
                              dir="ltr"
                              :class="[!item.url?'font-bold':'']">
                            <span class="p-menuitem-icon text-sm" :class="item.icon"></span>
                            {{ item.label }}
                        </Link>
                        <Link :href="item.url" v-else class="p-menuitem-link text-right" :class="[!item.url?'font-bold':'']"
                              dir="ltr">
                            <span class="p-menuitem-icon text-sm" :class="item.icon"></span>
                            {{ item.label }}
                        </Link>
                    </template>
                </Breadcrumb>
            </div>

        </header>

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
