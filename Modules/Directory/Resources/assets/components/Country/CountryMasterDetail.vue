<template>
    <div class="country-master-details">
        <DxTabPanel>
            <DxItem
                title="Характеристики"
                template="country-attributes-tab"
            />
            <CountryAttributesTab
                slot="country-attributes-tab"
                :country-id="countryMasterDetailData.key.id"
            />

            <DxItem
                title="Основные сведения"
                template="country-details-tab"
            />
            <CountryDetailsTab
                slot="country-details-tab"

            />
        </DxTabPanel>

    </div>

</template>

<script>
    import {DxTabPanel, DxItem} from 'devextreme-vue/tab-panel';
    import CountryDetailsTab from './CountryDetailsTab.vue';
    import CountryAttributesTab from './CountryAttributesTab.vue';

    export default {
        name: "CountryMasterDetail",
        components: {
            DxTabPanel, DxItem, CountryDetailsTab, CountryAttributesTab
        },
        props: {
            countryMasterDetailData: {
                type: Object,
                default: () => ({})
            }
        },
       created() {
            console.log(this.countryMasterDetailData);
            // console.log(this.masterDetailData.key);
            // console.log(this.masterDetailData.data);
       }
    }
</script>

<style scoped>

</style>
