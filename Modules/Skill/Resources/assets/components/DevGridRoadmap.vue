<template>
    <div id="data-grid-roadmap">
        <DxDataGrid
            :data-source="dataSource"
            :remote-operations="remoteOperations"
            :columns="columns"
            :show-borders="true"
            :allow-column-resizing="true"
            :allow-column-reordering="true"
            @initialized="saveGridInstance"
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
                data-field='developer_id'
                caption="Разработчик"
                data-type="number"
                :allow-grouping="true"
                :allow-editing="true"
            >
                <DxLookup
                    :data-source="storeDeveloper"
                    value-expr="id"
                    display-expr="name"
                />
            </DxColumn>

            <DxColumn
                :width="210"
                :buttons="editButtons"
                type="buttons"
            >
            </DxColumn>

            <DxMasterDetail
                :enabled="true"
                template="dev-grid-roadmap-technology"
            />
            <template #dev-grid-roadmap-technology="roadmapMasterDetail">
                <DevGridRoadmapTechnology
                    :roadmapMasterDetailData="roadmapMasterDetail.data"
                />
            </template>


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

    import "font-awesome/css/font-awesome.css";
    import {DxCheckBox, DxSelectBox} from 'devextreme-vue';
    import axios from 'axios';
    import {
        DxDataGrid,
        DxMasterDetail,
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
    import DevGridRoadmapTechnology from './DevGridRoadmapTechnology';
    import 'whatwg-fetch';

    const url = 'http://basked.pr/api/skill';

    function handleErrors(response) {
        if (!response.ok)
            throw Error(response.statusText);
        return response;
    }

    function isNotEmpty(value) {
        return value !== undefined && value !== null && value !== "";
    }


    const storeDeveloper = new CustomStore({
        key: 'id',
        byKey: function (key) {
            return {id: key};
        },
        load: (loadOptions) => {
            return axios.get(`${url}/roadmaps/look-developers`).then(response => {
                return response.data
            });
        },
    });

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

                return fetch(`${url}/roadmaps${params}`)
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
                return axios.post(`${url}/roadmaps`, values, {method: "POST"});//.then());
            },
            remove: (key) => {
                return axios.delete(`${url}/roadmaps/` + encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
            },
            update: (key, values) => {
                return axios.put(`${url}/roadmaps/` + encodeURIComponent(key.id),  values, {method: "PUT"});//.then(handleErrors);
            },
            onUpdating: function (key, values) {
                console.log('onUpdating');
            },
            onUpdated: function (key, values) {
                console.log('onUpdated');
            }
        })
    };
    export default {
        name: "DevGridRoadmap",
        components: {
            DevGridRoadmapTechnology,
            DxSwitch,
            DxDataGrid,
            DxMasterDetail,
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
                storeDeveloper,
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
                pageSizes: [15, 30, 50],
                editButtons: ['delete','|',
                    {
                        hint: 'Reset category',
                        icon: 'fa fa-minus-square',
                        // visible: this.isCloneIconVisible,
                        onClick: this.resetDeveloperClick
                    }
                ],

            }
        },
        mounted() {
            // var a=JSON.parse(this.getColumns())
            // console.log( a);
            // var a1=JSON.parse(this.getColumns2())
            // console.log(a1);
        },
        methods: {
            saveGridInstance: function (e) {
                this.dataGridInstance = e.component;
            },
            refresh: function () {
                this.dataGridInstance.refresh();
            },
            // Обнуляем тип
            resetDeveloperClick(e) {
                return axios.put(`${url}/roadmaps/reset-developer/` + encodeURIComponent(e.row.key.id), {method: "PUT"}).then(
                    // обновляем таблицу
                    this.refresh
                );

            },

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
