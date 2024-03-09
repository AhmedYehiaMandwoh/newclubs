<template>
    <ElHeader>
        <template #header>
            <div class="flex">
                <AvatarProfile :label="usePage().props?.profile_row.name" :url="usePage().props?.profile_row.avatar_url"/>
                <aside>
                    <p class="font-bold text-xl">{{ usePage().props?.profile_row['name'] }}</p>
                    <p>{{$t('base.email')}} : <Text :value="usePage().props?.profile_row.email"/></p>
                </aside>
            </div>
        </template>
        <template #tabs>
            <Tabs :label="$t('base.main_data')" v-ability="Ability.M_HospitalityProviders_MAIN_DATA" :href="route('hospitalityproviders.profile.main-data',usePage().props?.profile_row.id)"/>
            <Tabs :label="$t('base.edit')" v-ability="Ability.M_HospitalityProviders_UPDATE" :href="route('hospitalityproviders.profile.edit',usePage().props?.profile_row.id)"/>
            <Tabs :label="$t('base.branches')" v-ability="Ability.M_HospitalityProviders_BRANCHES" :href="route('hospitalityproviders.profile.branches',usePage().props?.profile_row.id)"/>
        </template>
    </ElHeader>
</template>
<script setup>
import ElHeader from "@/Components/Profile/ElHeader.vue";
import Tabs from "@/Components/Profile/ElTabs.vue";
import {usePage} from "@inertiajs/vue3";
import {Ability} from "@/ability";
import AvatarProfile from "@/Components/Avatar/AvatarProfile.vue";

</script>
