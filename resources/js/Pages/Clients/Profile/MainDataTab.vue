<template>
    <ElContainer>
        <section class="grid grid-cols-2 mt-3 gap-4">
            <div>
                <label>{{ $t('base.name') }} : </label>
                <label class="underline">{{ data.row.name }}</label>
            </div>
            <div>
                <label>{{ $t('base.email') }} : </label>
                <label>{{ data.row.email }}</label>
            </div>
            <div>
                <label>{{ $t('base.phone') }} : </label>
                <label>{{ data.row.phone }}</label>
            </div>
        </section>
    </ElContainer>


</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";


const props = defineProps(['data']);


</script>
