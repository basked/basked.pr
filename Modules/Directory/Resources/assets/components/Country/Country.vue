<template>
    <div id="country">
        <DxDataGrid
            :data-source="dataSource"
            :columns="columns"
            :remote-operations="true"
            :show-borders="true"
            :allow-column-resizing="true"
            :allow-column-reordering="true"
        >
            <dx-editing
                :select-text-on-edit-start="selectTextOnEditStart"
                :start-edit-action="startEditAction"
                :allow-updating="true"
                :allow-adding="true"
                :allow-deleting="true"
                mode="batch"/>

            <dx-search-panel
                :visible="true"
                :highlight-case-sensitive="true"
            />
            <dx-filter-row :visible="true"/>
            <dx-header-filter :visible="true"/>
            <dx-paging :page-size="50"/>
            <dx-group-panel :visible="true"/>
            <dx-grouping :auto-expand-all="false"
                         :context-menu-enabled="true"
                         expand-mode="rowClick"
            />
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
        DxPager,
        DxEditing,
        DxLookup,
        DxGroupPanel,
        DxGrouping,
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
                return fetch(`/api/directory/countries${params}`)
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
                return axios.post(`/api/directory/countries`, values, {method: "POST"});//.then());
            },
            remove: (key) => {
                return axios.delete(`/api/directory/countries/` + encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
            },
            update: (key, values) => {
                return axios.put(`/api/directory/countries/` + encodeURIComponent(key.id), values, {method: "PUT"});//.then(handleErrors);
            }
        })
    };
    export default {
        name: "Country",
        components: {
            CountryMasterDetail,
            DxPager,
            DxEditing,
            DxLookup,
            DxGroupPanel,
            DxGrouping,
            DxDataGrid,
            DxColumn,
            DxPaging,
            DxMasterDetail,
            DxScrolling,
            DxSearchPanel,
            DxFilterRow,
            DxHeaderFilter
        },
        props: ['propsColumns', 'propsCaptions'],
        data() {
            return {
                columns: JSON.parse(this.getCaptions()),
                select: this.getColumns(),
                dataSource: gridDataSource,
                keyExpr: 'id',
                key: 'id',
                remoteOperations: {
                    filtering: true,
                    sorting: true,
                    summary: true,
                    paging: true,
                    grouping: true,
                    groupPaging: true,
                },
                pageSizes: [20, 30, 50],
                selectTextOnEditStart: true,
                startEditAction: 'click',
            }
        },
        methods: {
            getColumns() {
                return this.propsColumns;
            },
            getCaptions() {
                return JSON.parse(this.propsCaptions);
            }
        }
    }
</script>

<style scoped>

</style>
