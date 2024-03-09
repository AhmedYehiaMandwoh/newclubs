<template>
    <PageHead/>
    <slot/>
    <NotificationAlert/>
</template>

<script setup>
import NotificationAlert from "@/Layout/NotificationAlert.vue";
import PageHead from "@/Layout/PageHead.vue";
</script>

<style scoped>

</style>
