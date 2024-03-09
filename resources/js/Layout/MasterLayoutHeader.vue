<script setup>
import {ref} from "vue";
import SearchInput from "@/Components/Form/SearchInput.vue";
import Avatar from 'primevue/avatar';
import OverlayPanel from 'primevue/overlaypanel';
import {useDark, useToggle} from "@vueuse/core";
import ChangeLang from "@/Components/ChangeLang.vue";

const isDark = useDark();
const toggleDark = useToggle(isDark);
const ref_overlay_panel = ref();

</script>

<template>
    <header
        class="flex justify-between items-stretch p-3 border-b el-container shadow leading-5 ">
        <section
            class="flex space-x-3 space-x-reverse flex-wrap justify-center items-center leading-5 text-slate-800 dark:text-primary-100"
            style="direction: rtl;">
            <aside @click="$emit('toggle_aside_show_state');"
                   class="bg-slate-500/10 dark:bg-slate-500/20 cursor-pointer grid lg:hidden place-items-center py-1.5 px-2 rounded-lg">
                <i class="pi pi-bars text-xl"></i>
            </aside>

            <aside class="hidden md:flex items-center my-0 text-base font-bold divide-x divide-x-reverse"
                   style="line-height: 1.2; direction: rtl;">
                <label class="px-1">{{ $t('base.site_title') }}</label>
            </aside>
        </section>
        <section class="grow max-w-2xl px-8 lg:px-20" v-if="$page.props.allowSearch">
            <search-input/>
        </section>
        <section class="flex items-center gap-4">
            <button @click="toggleDark()"
                    type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                <svg id="theme-toggle-dark-icon" class="w-5 h-5" v-if="!isDark" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="w-5 h-5" v-else fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
            <ChangeLang/>
            <aside>
                <OverlayPanel ref="ref_overlay_panel" class="dark:bg-gray-700 dark:divide-gray-600"
                              style="width: max-content" :breakpoints="{'960px': '75vw'}">
                    <div class="">
                        <div
                            class="flex items-center py-3 px-4 text-sm font-medium leading-5 box-border text-slate-900 dark:text-primary-100 border-b border-gray-100 dark:border-dark-100"
                            style="direction: rtl; list-style: outside none none;">
                            <div class="inline-block relative flex-shrink-0 ml-3 font-medium box-border"
                                 style="direction: rtl; list-style: outside none none;">
                                <Avatar :image="$page.props.auth.user.avatar_url"
                                        :label="!$page.props.auth.user.avatar ? $page.props.auth.user.name.charAt(0).toUpperCase() : null"
                                        class="shadow  shadow-5xl ml-3" size="xlarge"/>
                            </div>
                            <div class="flex flex-col font-medium box-border"
                                 style="direction: rtl; list-style: outside none none;">
                                <div
                                    class="flex items-center text-lg font-semibold leading-6 box-border"
                                    style="direction: rtl; list-style: outside none none;">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <a class="text-base text-gray-400 dark:text-gray-300 cursor-pointer box-border hover:text-primary-500"
                                   style="text-decoration: none; transition: color 0.2s ease 0s, background-color 0.2s ease 0s; direction: rtl; list-style: outside none none;">
                                    {{ $page.props.auth.user.email }}
                                </a>
                            </div>
                        </div>
                        <div
                            class="block p-0 text-sm font-medium leading-5 box-border text-slate-900"
                            style="list-style: outside none none;">
                            <hr/>

                            <Link :href="route($page.props.links.auth)"
                                  class="flex flex-grow-0 flex-shrink-0 items-center py-3 px-4 font-medium text-gray-700 dark:text-primary-100  cursor-pointer box-border basis-full hover:bg-gray-100 dark:hover:bg-dark-100 hover:text-teal-700">
                                {{ $t('base.profileDetails') }}
                            </Link>
                            <Link :href="route($page.props.links.logout)" method="post"
                                  class="flex flex-grow-0 flex-shrink-0 items-center py-3 px-4 font-medium text-gray-700 dark:text-primary-100  cursor-pointer box-border basis-full hover:bg-gray-100 dark:hover:bg-dark-100 hover:text-teal-700">
                                {{ $t('base.logout') }}
                            </Link>

                        </div>
                    </div>
                </OverlayPanel>
                <div
                    class="flex space-x-2 space-x-reverse items-center bg-slate-500/10 dark:bg-slate-500/20 py-1 px-1.5 rounded-lg cursor-pointer text-slate-900 dark:text-primary-100"
                    @click="ref_overlay_panel.toggle">
                    <img :src="$page.props.auth.user?.avatar_url" class="h-8 w-8 rounded-full"/>
                    <span v-text="$page.props.auth.user?.name"/>
                </div>
            </aside>
        </section>
    </header>
</template>

