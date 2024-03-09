<template>
    <label class="flex" :for="id??name">
            <span class="align-middle">
                <input :id="id??name" :name="name"
                       type="checkbox"
                       v-model="form[name]"
                       class="inline-block w-4 form-checkbox rounded my-1 text-primary-500 outline-0 focus:ring-0"
                       autocomplete="off"
                       v-bind="$attrs"
                />
            </span>
        <span class="inline-block mb-1 text-black dark:text-white font-sans mx-2 align-middle" v-text="label"/>
    </label>
</template>

<script setup>
const props = defineProps({
    label: String,
    name: String,
    form: Object,
    id: String
})
</script>

<style scoped>

</style>
