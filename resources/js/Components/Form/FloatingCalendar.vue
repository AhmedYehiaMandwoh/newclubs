<template>
    <aside>
        <div class="p-float-label">
            <Calendar class="w-full" showIcon dateFormat="yy-mm-dd" :class="{ 'p-invalid': hasError() }" :minDate="minDate"
                :maxDate="maxDate" v-model="form[name]" iconDisplay="input" />
            <label class="floating-label">
                {{ label ?? $t('base.' + name) }}
                <SpanRequired v-if="required" />
            </label>

        </div>
        <span v-if="hasError()" class="text-red-500 pt-1 block">{{ form['errors'][name] }}</span>
    </aside>
</template>

<script setup>
import Calendar from 'primevue/calendar';
import SpanRequired from "@/Components/Form/SpanRequired.vue";

const props = defineProps({
    label: String,
    name: String,
    minDate: String,
    maxDate: String,
    form: Object,
    required: {
        type: Boolean,
        default: false
    },
})

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
</script>

<style scoped>
.p-float-label label {
    top: -6% !important;
}

</style>
