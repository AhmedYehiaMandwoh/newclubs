<template>
    <template v-if="value!=null">
        <SvgTrue v-bind="$attrs" class="text-green-500 inline-block" v-if="value"/>
        <SvgFalse class="text-orange-400 inline-block w-[15px]" v-else/>
    </template>
</template>

<script>
import SvgTrue from "@/Components/Svg/SvgTrue.vue";
import SvgFalse from "@/Components/Svg/SvgFalse.vue";

export default {
    name: "SvgTrueFalse",
    components: {SvgTrue, SvgFalse},
    props:{
        value:{default:null,type:Boolean},
    }
}
</script>

<style scoped>

</style>
