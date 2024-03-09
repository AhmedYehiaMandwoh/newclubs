<template>
    <ActionMenuItem icon="pi pi-trash" @click="displayConfirmation=true"
                    v-bind="$attrs" v-ability="ability"
                    :text="text??$t('base.delete')"/>

    <Dialog v-model:visible="displayConfirmation" :rtl="true" :style="{width: '450px'}"
            :header="$t('base.confirm_delete')"
            :modal="true">
        <div class="confirmation-content flex">
            <i class="pi pi-exclamation-triangle text-red-900 mr-3" style="font-size: 2rem"/>
            <span>
                    {{ $t('base.are_you_sure_delete') }}
                <b class="underline mx-2">{{ props.dialogMessage ?? '' }}</b>
                    ؟
            </span>
        </div>
        <template #footer>
            <div class="text-center">
                <Button :label="$t('base.no')" icon="pi pi-times" class="py-2 p-button-secondary"
                        :disabled="form.processing" @click="displayConfirmation=false"/>
                <Button :label="$t('base.yes')" icon="pi pi-check" class="py-2 p-button-danger2"
                        :disabled="form.processing" @click="submitConfirmation"/>
            </div>
        </template>

    </Dialog>
</template>

<script setup>
import {ref} from "vue";
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import {useForm} from "@inertiajs/vue3";
import ActionMenuItem from "@/Components/ActionMenu/ActionMenuItem.vue";

const form = useForm({});
const props = defineProps({
    href: {type: String, default: null},
    text: {type: String, default: null},
    ability: {type: String, default: null},
    dialogMessage: {type: String, default: null},
})
const displayConfirmation = ref(false);
const submitConfirmation = () => {
    form.delete(props.href, {
        preserveState: false,
    });
}
</script>

<style scoped>

</style>
