<template>
    <div id="data-grid-languages">
        <dx-data-grid
            :data-source="dataSource"
            :remote-operations="remoteOperations"
            :columns="columns"
            :show-borders="true"
            :allow-column-resizing="true"
            :allow-column-reordering="true"
        >

            <DxColumn
                :width="125"
                data-field="id"/>
            <DxColumn
                :width="250"
                data-field="name"/>
            <DxColumn
                :width="250"
                data-field="slug"/>
            <DxColumn
                :width="250"
                data-field="descr"/>

            <DxColumn
                :width="125"
                data-field="type_id"
                caption="Type"
            >
                <DxLookup
                    :data-source="dsTypes"
                    display-expr="Name"
                    value-expr="ID"
                />
            </DxColumn>
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
            <dx-paging :page-size="20"/>
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
        DxHeaderFilter,


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

    const gridDataSourceTypes = {
        store: new CustomStore({
            key:'id',
            byKey: (key) => {
                return fetch("/api/skill/technologies/types");
            },
            load: () => {
                return fetch(`/api/skill/technologies/types`)
                    .then(handleErrors)
                    .then(response => response.json())
                    .then((result) => {
                        console.log(response)
                        return {
                            key: result.data.id,
                            data: result.data,
                        }
                    });

            }
        })
    };
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

                return fetch(`/api/skill/technologies${params}`)
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
                return axios.post(`/api/skill/technologies`, values, {method: "POST"});//.then());
            },
            remove: (key) => {
                return axios.delete(`/api/skill/technologies/` + encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
            },
            update: (key, values) => {
                return axios.put(`/api/skill/technologies/` + encodeURIComponent(key.id), values, {method: "PUT"});//.then(handleErrors);
            }
        })
    };
    export default {
        name: "DevGridLanguage",
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
                dsTypes: gridDataSourceTypes,
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
                selectTextOnEditStart: true,
                startEditAction: 'click',
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
