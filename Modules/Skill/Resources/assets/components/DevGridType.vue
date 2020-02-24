<template>
    <div id="data-grid-types">
        <DxDataGrid
            :data-source="dataSource"
            :remote-operations="remoteOperations"
            :columns="columns"
            :show-borders="true"
            :allow-column-resizing="true"
            :allow-column-reordering="true"
        >
            <DxEditing
                :allow-updating="true"
                :allow-adding="true"
                :allow-deleting="true"
                mode="batch"/>
            <DxSearchPanel
                :visible="true"
                :highlight-case-sensitive="true"
            />
            <DxFilterRow :visible="true"/>
            <DxHeaderFilter :visible="true"/>
            <DxGroupPanel :visible="true"/>
            <DxGrouping :auto-expand-all="false"
                         :context-menu-enabled="true"
                         expand-mode="rowClick"
            />
            <DxPager
                :allowed-page-sizes="pageSizes"
                :show-page-size-selector="true"
            />
            <DxPaging :page-size="20"/>
        </DxDataGrid>
    </div>

</template>
<script>
    import 'devextreme/dist/css/dx.common.css';
    import 'devextreme/dist/css/dx.material.orange.dark.compact.css';
    import {DxCheckBox, DxSelectBox} from 'devextreme-vue';
    import axios from 'axios';
    import {
        DxDataGrid,
        DxColumn,
        DxPaging,
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
    import {DxSwitch} from 'devextreme-vue/switch';
    import CustomStore from 'devextreme/data/custom_store';

    import 'whatwg-fetch';

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
                console.log(params);
                params = params.slice(0, -1);

                return fetch(`/api/skill/types${params}`)
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
                return axios.post(`/api/skill/types`, values, {method: "POST"});//.then());
            },
            remove: (key) => {
                return axios.delete(`/api/skill/types/` + encodeURIComponent(key.id), { method: "DELETE"  });//.then(handleErrors);
            },
            update: (key, values) => {
                return axios.put(`/api/skill/types/` + encodeURIComponent(key.id), values,);//.then(handleErrors);
            }
        })
    };
    export default {
        name: "DevGridSprType",
        components: {
            DxSwitch,
            DxDataGrid,
            DxEditing,
            DxCheckBox,
            DxSelectBox,
            DxGroupPanel,
            DxGrouping,
            DxScrolling,
            DxLookup,
            DxPaging,
            DxPager,
            DxColumn,
            DxSearchPanel,
            DxFilterRow,
            DxHeaderFilter
        },
        props: ['propsColumns', 'propsCaptions'],
        data() {
            return {
                dataSource: gridDataSource,
                columns: JSON.parse(this.getCaptions()),
                select: this.getColumns(),
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
            }
        },
        mounted() {
            // var a=JSON.parse(this.getColumns())
            // console.log( a);
            // var a1=JSON.parse(this.getColumns2())
            // console.log(a1);
        },
        methods: {

            getColumns() {
                return this.propsColumns;
            },
            getCaptions() {
                return JSON.parse(this.propsCaptions);
            }
        }
    };
</script>
<style>
    #data-grid-units {
        width: 100%;
    }

    .options {
        margin-top: 20px;
        padding: 20px;
        /*background: #f5f5f5;*/
    }

    .options .caption {
        font-size: 18px;
        font-weight: 500;
    }

    .option {
        margin-top: 10px;
    }

    .option > span {
        width: 120px;
        display: inline-block;
    }

    .option > .dx-widget {
        display: inline-block;
        vertical-align: middle;
        width: 100%;
        max-width: 100%;
    }
</style>
