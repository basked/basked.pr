<template>
    <div id="country">
        <DxDataGrid
            :data-source="dataSource"
            :remote-operations="true"
            :show-borders="true"
        >
            <dx-search-panel
            :visible="true"
            :highlight-case-sensitive="true"
        />
            <dx-filter-row :visible="true"/>
            <dx-header-filter :visible="true"/>
            <DxPaging :page-size="50"/>
<!--            <DxColumn data-field="id" visible="false"/>-->
            <DxColumn data-field="name"/>
            <DxColumn data-field="slug"/>
            <DxMasterDetail
                :enabled="true"
                template="country-master-detail"
            />
            <!--            в props дочернего передаем именно так данные из основного грида-->
            <template #country-master-detail="countryMasterDetail">
                <CountryMasterDetail :countryMasterDetailData="countryMasterDetail.data"/>
            </template>
        </DxDataGrid>
    </div>
</template>

<script>
    import 'devextreme/dist/css/dx.common.css';
    import 'devextreme/dist/css/dx.darkmoon.compact.css';
    import CountryMasterDetail from "./CountryMasterDetail";
    import axios from 'axios';
    import {
        DxDataGrid,
        DxColumn,
        DxPaging,
        DxMasterDetail,
        // DxPager,
        // DxEditing,
        // DxLookup,
        // DxGroupPanel,
        // DxGrouping,
        DxScrolling,
        DxSearchPanel,
        DxFilterRow,
        DxHeaderFilter
    } from 'devextreme-vue/data-grid';
    import 'whatwg-fetch';
    import CustomStore from "devextreme/data/custom_store";


    function handleErrors(response) {
        if (!response.ok)
            throw Error(response.statusText);
        return response;
    }

    function isNotEmpty(value) {
        return value !== undefined && value !== null && value !== "";
    }

    const gridDataSource = {
        store: new CustomStore({
            load: (loadOptions) => {
                let params = "?";
                [
                    "skip",
                    "take",
                    "requireTotalCount",
                    "requireGroupCount",
                    "sort",
                    "filter",
                    "totalSummary",
                    "group",
                    "groupSummary"
                ].forEach(function (i) {
                    if (i in loadOptions && isNotEmpty(loadOptions[i]))
                        params += `${i}=${JSON.stringify(loadOptions[i])}&`;
                });

                params = params.slice(0, -1);
                return fetch(`/api/directory/country${params}`)
                    .then(handleErrors)
                    .then(response => response.json())
                    .then((result) => {
                        return {
                            key: result.data.id,
                            data: result.data,
                            totalCount: result.totalCount,
                            summary: result.summary,
                            groupCount: result.groupCount
                        }
                    });
            },
            insert: (values) => {
                return axios.post(`/api/directory/country`, values, {method: "POST"});//.then());
            },
            remove: (key) => {
                return axios.delete(`/api/directory/country/` + encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
            },
            update: (key, values) => {
                return axios.put(`/api/directory/country/` + encodeURIComponent(key.id), values, {method: "PUT"});//.then(handleErrors);
            }
        })
    };
    export default {
        name: "Country",
        components: {
            CountryMasterDetail,
            DxDataGrid, DxColumn, DxPaging, DxMasterDetail, DxScrolling,
            DxSearchPanel,
            DxFilterRow,
            DxHeaderFilter
        },
        data() {
            return {
                dataSource: gridDataSource,
            }
        }
    }
</script>

<style scoped>

</style>
