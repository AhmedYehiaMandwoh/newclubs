<template>
    <Head>
        <title v-if="$page.props.pageTitle">{{$page.props.pageTitle}}</title>
    </Head>

</template>

<script setup>
import { Head } from '@inertiajs/vue3'
</script>
