<script setup>
import {ref, watch} from "vue";
import InputText from 'primevue/inputtext';
import {refDebounced} from "@vueuse/core";
import {router} from "@inertiajs/vue3";
import {useQuery} from "@/Helpers/useQuery.js";

const search=ref(useQuery().get('search'));
const processing=ref(false);
const searchD = refDebounced(search, 500);
watch(searchD, (search) => {
    processing.value=true;
    router.reload({
        data: {search},
        onFinish: () => {
            processing.value=false;
        },
    })
})

</script>

<template>
    <label class="w-full p-input-icon-left text-dark-500 relative">
        <i v-if="!processing" class="pi pi-search absolute left-[15px] bottom-[3px]"/>
        <i v-else class="pi pi-spin pi-spinner absolute left-[15px] bottom-[3px]"/>
        <InputText v-model="search" class="w-full" size="small" :placeholder="$t('base.search_here')"/>
    </label>
</template>
