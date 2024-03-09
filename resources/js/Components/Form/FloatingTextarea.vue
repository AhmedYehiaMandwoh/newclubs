<template>
    <div class="p-input-filled py-3">
        <div class="p-float-label relative">
            <Textarea v-model="form[name]" :id="name" class="w-full"
                      style="padding-top:17px!important;"
                      :rows="rows?? '10'" :cols="cols ?? '30'"
                      :class="{'p-invalid':hasError()}  "/>
            <label :for="name" class="absolute">
                {{ label ?? $t('base.' + name) }}
                <span v-if="required" class="text-red-500">*</span>
            </label>
        </div>
        <span v-if="hasError()" class="text-red-500 pt-1 block">{{ form['errors'][name] }}</span>
    </div>
</template>

<script setup>
import Textarea from 'primevue/textarea';
const props=defineProps({
    label: String,
    name: String,
    form: Object,
    rows: Number,
    cols: Number,
    required: Boolean,
});
const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
</script>

<style scoped>
.p-inputtextarea {
    border: 1px solid #d9d9d9 !important;
    border-radius: 5px !important;
    min-height: 150px !important;
}
</style>
