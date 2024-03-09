<template>
    <aside>
        <div class="p-float-label">
            <InputText class="w-full" :type="type" :class="{'p-invalid':hasError()}" v-model="form[name]"/>
            <label class="floating-label">
                {{ label??$t('base.'+name) }}
                <SpanRequired v-if="required"/>
            </label>
        </div>
        <span v-if="hasError()" class="text-red-500 pt-1 block">{{ form['errors'][name] }}</span>
    </aside>
</template>

<script setup>
import InputText from 'primevue/inputtext';
import SpanRequired from "@/Components/Form/SpanRequired.vue";

const props = defineProps({
    label: String,
    name: String,
    type: {
        type: String,
        default: 'text'
    },
    form: Object,
    required:  {
        type: Boolean,
        default: false
    },
})

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
</script>

<style scoped>

</style>
