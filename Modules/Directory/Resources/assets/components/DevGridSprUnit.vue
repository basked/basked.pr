<template>
    <div id="data-grid-relationship">
        <dx-data-grid
            :data-source="dataSource"
            :remote-operations="remoteOperations"
            :columns="columns"
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
            <dx-group-panel :visible="true"/>
            <dx-grouping :auto-expand-all="false"
                         :context-menu-enabled="true"
                         expand-mode="rowClick"
            />
            <dx-pager
                :allowed-page-sizes="pageSizes"
                :show-page-size-selector="true"
            />
            <dx-paging :page-size="10"/>
        </dx-data-grid>
        <div class="options">
            <div class="caption">Options</div>
            <div class="option">
                <dx-check-box
                    v-model="selectTextOnEditStart"
                    text="Поиск..."
                />
            </div>
            <div class="option">
                <span>Start Edit Action</span>
                <dx-select-box
                    :items="['click', 'dblClick']"
                    v-model="startEditAction"
                />
            </div>
        </div>
    </div>

</template>
<script>
    import 'devextreme/dist/css/dx.common.css';
    import 'devextreme/dist/css/dx.darkmoon.compact.css';
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

                return fetch(`http://basked.pr/api/directory/unit${params}`)
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
                return axios.post(`api/directory/unit`, values);//.then(handleErrors);
            },
            remove: (key) => {
                return axios.delete(`api/directory/unit` + encodeURIComponent(key.id), {
                    method: "DELETE"
                });//.then(handleErrors);
            },
            update: (key, values) => {
                return axios.put(`api/directory/unit` + encodeURIComponent(key.id), values);//.then(handleErrors);
            }
        })
    };
    export default {
        name: "DevGridSprUnit",
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
        data() {
            return {
                columns: [

                    {dataField: "id", caption:"ID" },
                    {dataField: "code", caption:"Код" },
                    {dataField: "name", caption:"Наименование" },
                    {dataField: "slug", caption:"SLUG" },
                    {dataField: "symbol_national", caption:"Национальное симаольное обозначение" },
                    {dataField: "symbol_intern", caption:"Междунородное симаольное обозначение" },
                    {dataField: "code_national", caption:"Национальное кодовое обозначение" },
                    {dataField: "code_intern", caption:"Междунородное кодовое обозначение" },
                    {dataField: "section", caption:"Раздел" },
                    {dataField: "unit_group", caption:"Группа" },

                ],
                dataSource: gridDataSource,
                select: [
                    'id',
                    'code',
                    'name',
                    'slug',
                    'symbol_national',
                    'symbol_intern',
                    'code_national',
                    'code_intern',
                    'section',
                    'unit_group',
                    'descr'
                ],
                keyExpr: 'id',
                key : 'id',
                remoteOperations: {
                    filtering: true,
                    sorting: true,
                    summary: true,
                    paging: true,
                    grouping: true,
                    groupPaging: true,
                },
                pageSizes: [10, 25, 50],
                selectTextOnEditStart: true,
                startEditAction: 'click',
            }
        },
        mounted() {
                 // axios.get(`api/directory/unit/`).then(response => (console.log(response));
            //    console.log(this.categories);
        }
    };
</script>
<style>
    #data-grid-relationship {
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
