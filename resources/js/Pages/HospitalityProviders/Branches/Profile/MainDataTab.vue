<template>
    <ElContainer>
        <section class="grid grid-cols-2 mt-3 gap-4">
            <div>
                <label>{{ $t('base.name') }} : </label>
                <label class="underline">{{ data.row.name }}</label>
            </div>
            <div>
                <label>{{ $t('base.latitude') }} : </label>
                <label>{{ data.row.latitude }}</label>
            </div>
            <div>
                <label>{{ $t('base.longitude') }} : </label>
                <label>{{ data.row.longitude }}</label>
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
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";


const props = defineProps(['data']);
const form_remove_permission = useForm({
    name: null
});
const form_edit_permission = useForm({
    abilities: props.data?.active_custom_abilities ?? [],
});
const removePermission = (name) => {
    form_remove_permission.name = name
    form_remove_permission.delete(route('users.remove-custom-permission',props.data.row.id), {
        onSuccess: (response) => {
            window.location.reload();
        },
        onError: (error) => console.log(error)
    });
}
const dialogEdit = ref(false);

const updatePermission = () => {
    form_edit_permission.post(route('users.edit-custom-permission',props.data.row.id), {
        onSuccess: () => {
            dialogEdit.value = false;
        },
        onError: (error) => console.log(error)
    }, {
        forceFormData: true,
    });
}
</script>
