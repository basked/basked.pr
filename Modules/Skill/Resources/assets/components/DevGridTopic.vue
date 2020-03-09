<template>
    <div id="data-grid-topic">
        <DxDataGrid
            :data-source="dataSource"
            :remote-operations="remoteOperations"
            :columns="columns"

            :show-borders="true"
            :allow-column-resizing="true"
            :allow-column-reordering="true"
            @initialized="saveGridInstance"
            @row-click="onRowClick"
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
                data-field='technology_id'
                caption="Технология"

            >
                <DxLookup
                    :data-source="storeTechnology"
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
                template="dev-grid-topic-tabs"
            />
            <template #dev-grid-topic-tabs="topicMasterDetail">
                <DevGridTopicTabs
                    :topicMasterDetailData="topicMasterDetail.data"
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
    // import DevGridRoadmapTechnology from './DevGridRoadmapTechnology';
    import DevGridTopicTabs from './DevGridTopicTabs';
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


    const storeTechnology = new CustomStore({
        key: 'id',
        byKey: function (key) {
            return {id: key};
        },
        load: (loadOptions) => {
            return axios.get(`${url}/topics/look-technologies`).then(response => {
                return response.data
            });
        },
    });

    export default {
        name: "DevGridTopic",
        components: {
            DevGridTopicTabs,
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
        props: {
            propsColumns: String,
            propsCaptions: String,
            propsTechnology_id: {
                type: String,
                required: true
            },},
        data() {
            return {
                storeTechnology,
                // dataSource: gridDataSource,
                dataSource: new CustomStore({
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
                        let url_topics = ``;
                        console.log(this.propsTechnology_id);
                        // this.propsTechnology_id == -1 - если из маршрута /topics
                        // иначе если из маршрута url_topics = url+'/technology/'+this.propsTechnology_id+'/topics'
                        if (this.propsTechnology_id == 0) {
                            url_topics = `${url}/topics${params}`
                        } else {
                            url_topics = url + '/technology/' + this.propsTechnology_id + '/topics' + `${params}`
                        };
                        return fetch(url_topics)
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
                        return axios.post(`${url}/topics`, values, {method: "POST"});//.then());
                    },
                    remove: (key) => {
                        return axios.delete(`${url}/topics/` + encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
                    },
                    update: (key, values) => {
                        return axios.put(`${url}/topics/` + encodeURIComponent(key.id), values, {method: "PUT"});//.then(handleErrors);
                    }
                }),


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
                editButtons: ['delete', '|',
                    {
                        hint: 'Reset category',
                        icon: 'fa fa-minus-square',

                        onClick: this.resetTechnologyClick
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
                console.log(e.component);
                this.dataGridInstance = e.component;
            },
            refresh: function () {
                this.dataGridInstance.refresh();
            },
            // Обнуляем тип
            resetTechnologyClick(e) {
                return axios.put(`${url}/topics/reset-technology/` + encodeURIComponent(e.row.key.id), {method: "PUT"}).then(
                    // обновляем таблицу
                    this.refresh
                );

            },

            getColumns() {
                return this.propsColumns;
            },
            getCaptions() {
                return JSON.parse(this.propsCaptions);
            },
            onRowClick(e) {
                console.log('ROWClick', e);
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
