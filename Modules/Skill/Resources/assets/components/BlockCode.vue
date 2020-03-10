<template>
    <div class="block-code">
        <h1>{{lang}}</h1>
        <pre v-highlightjs><code :class="lang">{{code}}</code></pre>
    </div>
</template>

<script>

    import VueHighlightJS from 'vue-highlightjs'
    Vue.use(VueHighlightJS)
    export default {
        name: "BlockCode",
        props:{
            propCode:{
                type: String,
                default: () => ("baket")
            },
            propLang:{
                type: String,
                default: () => ("javascript")
            }
        },
        data(){
            return{
                code:this.propCode,
                lang:this.propLang
            }
        }
    }
</script>

<style scoped>

</style>
