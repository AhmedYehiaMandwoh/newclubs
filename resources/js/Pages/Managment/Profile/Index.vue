<template>
    <ElPanel is-transparent="1">
        <ElProfile>
            <template #header>
                <Header/>
            </template>

            <template #tabContentTransparent>
                <component :is="tapComponent[$page.props.tap_component]" :data="data"/>
            </template>
        </ElProfile>
    </ElPanel>

</template>
<script setup>
import ElProfile from "@/Components/Profile/ElProfile.vue";

import Header from "./Header.vue";
import EditTab from "./EditTab.vue";
import MainDataTab from "./MainDataTab.vue";
import TabBranchesData from "./TabBranchesData.vue";

const tapComponent = {
    'EditTab': EditTab,
    'MainDataTab': MainDataTab,
    'TabBranchesData': TabBranchesData,
};
const props = defineProps({
    data: {
        type: Object,
        default: []
    },
})

</script>

