<template>
    <section v-bind="$attrs"
             class="flex leading-5 shadow border-e lg:fixed lg:inset-y-0 lg:start-0 el-container">
        <div class="flex flex-col w-full">
            <div
                class="flex-col flex-none items-center pb-5 pt-2 flex">
                <a class="text-primary-500 cursor-pointer box-border hover:text-yellow-700"
                   style="text-decoration: none; transition: color 0.2s ease 0s, background-color 0.2s ease 0s; direction: rtl;">
                    <img alt="Logo" :src="asset('images/logofull.jpg')"
                         class="m-auto w-auto px-2 align-middle box-border max-h-[70px]"/>
                </a>
            </div>
            <div class="flex flex-col px-2 flex-grow flex-shrink-0 pb-5 items-center w-full basis-auto h-full">
                <ScrollPanel style="width:100%;height: calc(-180px + 100vh )"
                             class="p-scrollpanel-bar-y aside-scroll-panel relative">
                    <ul class="w-full divide-y divide-slate-100 dark:divide-slate-700 font-bold">
                        <li v-for="item in $page.props.menu" class="py-2 leading-5 box-border">
                            <Link :href="item.href"
                                  class="flex justify-center items-center"
                                  :class="{'text-primary-600 active':item.active,
                                          'text-slate-600 dark:text-white': !item.active}">
                                <label class="block text-center">
                                    <i class="pi text-lg align-middle py-1 px-1.5"
                                       :class="item.icon"></i>
                                </label>
                                <label class="text-xs md:text-sm w-full" v-text="$t(item.label)"/>
                            </Link>
                        </li>
                    </ul>
                </ScrollPanel>
            </div>
        </div>
    </section>
</template>

<script setup>
import {asset} from "@/Helpers/Functions.js";
</script>
