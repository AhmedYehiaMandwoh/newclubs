<template>
    <aside>
        <div class="p-float-label">
            <Dropdown :options="options" :optionLabel="optionLabel" :option-value="optionValue"
                      class="w-full" filter
                      :class="{'p-invalid':hasError()}" v-model="form[name]"/>
            <label class="floating-label">
                {{ label ?? $t('base.' + form[name]) }}
                <SpanRequired v-if="required"/>
            </label>
        </div>
        <span v-if="hasError()" class="text-red-500 pt-1 block">{{ form['errors'][form[name]] }}</span>
    </aside>
</template>

<script setup>
import Dropdown from 'primevue/dropdown';
import SpanRequired from "@/Components/Form/SpanRequired.vue";

const props = defineProps({
    label: String,
    name: String,
    options: {type: Object, default: null},
    optionLabel: {type: String, default: 'name'},
    optionValue: {type: String, default: 'id'},
    form: Object,
    required: {
        type: Boolean,
        default: false
    },
})

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
</script>

<style scoped>

</style>
