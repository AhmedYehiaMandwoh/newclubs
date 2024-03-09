<template>
    <ElPanel is-transparent="1">
        <ElProfile>
            <template #header>
                <Header/>
            </template>

            <template #tabContentTransparent>
                <component :is="tapComponent[$page.props.tap_component]" :data="data" :form_data="form_data['form_data']" :branch_id="branch_id"/>
            </template>
        </ElProfile>
    </ElPanel>

</template>
<script setup>
import ElProfile from "@/Components/Profile/ElProfile.vue";

import Header from "./Header.vue";
import EditTab from "./EditTab.vue";
import MainDataTab from "./MainDataTab.vue";
import TabOffersData from "./TabOffersData.vue";

const tapComponent = {
    'EditTab': EditTab,
    'MainDataTab': MainDataTab,
    'TabOffersData': TabOffersData,
};
const props = defineProps({
    data: {
        type: Object,
        default: []
    },
    form_data: {
        type: Object,
        default: {}
    },
    branch_id: {
        type: String,
        default: null
    },
})

</script>

