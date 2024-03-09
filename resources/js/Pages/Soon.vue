<script setup>

import {asset} from "@/Helpers/Functions.js";
</script>

<template>
    <div class="flex h-screen justify-center items-center">
        <div class="text-center text-3xl">
            <img :src="asset('images/logo.jpg')" class="w-[150px]" alt="logo"/>
            {{$t('base.soon')}}
        </div>
    </div>
</template>

<style scoped>

</style>
