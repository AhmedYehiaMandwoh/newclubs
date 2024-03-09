<template>
    <ElHeader>
        <template #header>
            <div class="flex">
                <a :href="usePage().props?.profile_row.qr_image" download>
                    <img :src="usePage().props?.profile_row.qr_image" alt="" width="100">
                </a>
            </div>
        </template>
        <template #tabs>
            <Tabs :label="$t('base.main_data')"
                :href="route('hospitality_providers.branches.profile.main-data', usePage().props?.profile_row.id)" />
            <Tabs :label="$t('base.edit')"
                :href="route('hospitality_providers.branches.profile.edit', usePage().props?.profile_row.id)" />
            <Tabs :label="$t('base.offers')"
                :href="route('hospitality_providers.branches.profile.viewOffers', usePage().props?.profile_row.id)" />
        </template>
    </ElHeader>
</template>
<script setup>
import ElHeader from "@/Components/Profile/ElHeader.vue";
import Tabs from "@/Components/Profile/ElTabs.vue";
import { usePage } from "@inertiajs/vue3";
import { Ability } from "@/ability";
import AvatarProfile from "@/Components/Avatar/AvatarProfile.vue";

</script>
