<template>
    <PageHead />
    <div class="flex flex-col p-0 m-0 font-sans text-xs font-normal leading-5
    box-border bg-slate-50 dark:bg-dark-500 text-slate-900
    md:overscroll-contain print:overflow-scroll h-screen print:h-auto">
        <div class="flex flex-row flex-grow flex-shrink-0 leading-5 box-border basis-auto text-slate-900">
            <MasterLayoutAsideBar class="w-[15rem]" />
            <main class="w-full h-screen ps-[15rem] el-main">
                <MasterLayoutHeader />
                <ScrollPanel style="width:100%;height: calc(-50px + 100vh )">
                    <slot />
                </ScrollPanel>
            </main>
        </div>
    </div>
    <NotificationAlert />
</template>

<script setup>
import NotificationAlert from "@/Layout/NotificationAlert.vue";
import MasterLayoutAsideBar from "@/Layout/MasterLayoutAsideBar.vue";
import MasterLayoutHeader from "@/Layout/MasterLayoutHeader.vue";
import PageHead from "@/Layout/PageHead.vue";
</script>

<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
</style>
