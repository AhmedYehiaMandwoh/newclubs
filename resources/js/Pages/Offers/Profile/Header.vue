<template>
    <ElHeader>
        <template #header>
            <div class="flex">
                <AvatarProfile :label="usePage().props?.profile_row.name" :url="usePage().props?.profile_row.icon_url"/>
                <aside>
                    <p class="text-xl"><span class="font-bold">{{$t('base.name')}} :</span> {{ usePage().props?.profile_row['name'] }}</p>
                    <p class="text-xl"><span class="font-bold">{{$t('base.valid_to_type')}} :</span> {{ usePage().props?.profile_row['valid_to_type_text'] }}</p>
                    <p class="text-xl"><span class="font-bold">{{$t('base.max_used')}} :</span> {{ usePage().props?.profile_row['max_used']}}</p>

                </aside>
            </div>
        </template>
        <template #tabs>
            <Tabs :label="$t('base.main_data')"
                :href="route('offers.profile.main-data', usePage().props?.profile_row.id)" />
            <Tabs :label="$t('base.edit')"
                :href="route('offers.profile.edit', usePage().props?.profile_row.id)" />
        </template>
    </ElHeader>
</template>
<script setup>
import ElHeader from "@/Components/Profile/ElHeader.vue";
import Tabs from "@/Components/Profile/ElTabs.vue";
import { usePage } from "@inertiajs/vue3";
import AvatarProfile from "@/Components/Avatar/AvatarProfile.vue";

</script>
