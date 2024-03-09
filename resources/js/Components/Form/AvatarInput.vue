<template>
    <aside class="h-full">
        <div class="text-start">
            <label :for="name" class="px-2 font-bold" :class="{'p-error':hasError()}">
                {{ label??$t('base.'+name) }}
                <SpanRequired v-if="required"/>
            </label>
        </div>
        <input :id="name" type="file" accept="image"
            :required="required" class="hidden"
            @input="form[name]=$event.target.files[0]" @change="change">
        <div class="w-full h-full">
            <div class="block h-full w-full relative pl-[15px] text-primary-500">
                <Image v-if="oldImagePreview && form[name]==null"
                       preview="1" :src="oldImagePreview"
                       class="m-auto block fill-primary-500 hover:fill-primary-800"/>
                <Avatar v-else
                        :image="preview??oldImagePreview??form[name]"
                        class="bg-origin-content bg-contain"
                        shape="squre"
                        size="xlarge"
                        :label="preview || form[name]?null:''"/>
                <label :for="name"
                       class="absolute bg-white dark:bg-dark-500 text-gray-500 top-[-12px] p-1 rtl:left-0 ltr:right-0">
                    <SvgEdit/>
                </label>
            </div>
            <span v-if="hasError()" class="text-red-500 pt-1 block">{{ form['errors'][name] }}</span>
        </div>
    </aside>
</template>

<script setup>
import Avatar from 'primevue/avatar';
import Image from 'primevue/image';
import SvgEdit from "@/Components/Svg/SvgUpload.vue";
import {ref} from "vue";
import SpanRequired from "@/Components/Form/SpanRequired.vue";

const props = defineProps({
    label: String,
    name: String,
    form: Object,
    required: {type: Boolean, default: false},
    oldImagePreview: {type: String, default: null},
});
const preview = ref();
const change = (e) => {
    // this.$emit('input', e.target.files[0]);
    let reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.onload = (e) => {
        preview.value = e.target.result;
    }
}
const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
</script>

<style scoped>

</style>
