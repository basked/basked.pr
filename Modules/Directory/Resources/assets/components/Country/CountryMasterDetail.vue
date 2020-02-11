<template>
    <DxTabPanel>
        <DxItem
            title="Основные сведения"
            template="country-details-tab"
        />
        <CountryDetailsTab slot="country-details-tab">

        </CountryDetailsTab>

        <DxItem
            title="Характеристики"
            template="country-attributes-tab"
        />
        <CountryAttributesTab  slot="country-attributes-tab">

        </CountryAttributesTab>
    </DxTabPanel>
</template>

<script>
    import {DxTabPanel, DxItem} from 'devextreme-vue/tab-panel';
    import CountryDetailsTab from './CountryDetailsTab.vue';
    import CountryAttributesTab from './CountryAttributesTab.vue';

    export default {
        name: "CountryMasterDetail",
        components: {
            DxTabPanel, DxItem, CountryDetailsTab, CountryAttributesTab
        }
    }
</script>

<style scoped>

</style>
