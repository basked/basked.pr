<template>
    <div class="dev-grid-topic-tabs">
        <DxTabPanel>
            <DxItem
                title="Примеры"
                template="dev-grid-topic-examples"
            />
            <DevGridTopicExamples
                slot="dev-grid-topic-examples"
                :topicMasterDetailData="topicMasterDetailData"
            />
            <DxItem
                title="Ссылки для изучения"
                template="dev-grid-topic-links"
            />
            <DevGridTopicLinks
                slot="dev-grid-topic-links"
                :topicMasterDetailData="topicMasterDetailData"
            />

        </DxTabPanel>

    </div>

</template>

<script>
    import {DxTabPanel, DxItem} from 'devextreme-vue/tab-panel';
    import DevGridTopicExamples from './DevGridTopicExamples.vue';
    import DevGridTopicLinks from './DevGridTopicLinks.vue';

    export default {
        name: "DevGridTopicTabs",
        components: {
            DxTabPanel, DxItem, DevGridTopicExamples,DevGridTopicLinks
        },
        props: {
             topicMasterDetailData: {
                type: Object,
                default: () => ({})
            }
        },
        created() {
            console.log(this.topicMasterDetailData);
            // console.log(this.masterDetailData.key);
            // console.log(this.masterDetailData.data);
        }
    }
</script>

<style scoped>

</style>
