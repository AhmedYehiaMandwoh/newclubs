<template>
    <ElContainer>
        <section class="grid grid-cols-2 mt-3 gap-4">
            <div>
                <label>{{ $t('base.name') }} : </label>
                <label class="underline">{{ data.row.name }}</label>
            </div>
            <div>
                <label>{{ $t('base.created_at_text') }} : </label>
                <label>{{ data.row.created_at_text }}</label>
            </div>
        </section>
    </ElContainer>


</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";


const props = defineProps(['data']);


</script>
