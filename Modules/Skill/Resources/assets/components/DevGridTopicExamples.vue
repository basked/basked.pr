<template>
    <div id="dev-grid-topic-examples">
        <DxDataGrid
            :data-source="dataSource"
        >
            <DxColumn
                :width="125"
                :visible="false"
                data-field="id"/>
            <DxColumn
                :width="500"
                data-field="name"/>
            <DxColumn
                :width="250"
                :visible="false"
                data-field="code">
                <DxFormItem
                    :col-span="2"
                    :editor-options="{ height: 100 }"
                    editor-type="dxTextArea"
                />
            </DxColumn>
            <DxColumn
                :width="210"
                :buttons="editButtons"
                type="buttons"/>
            <DxEditing
                :allow-updating="true"
                :allow-adding="true"
                :allow-deleting="true"
                mode="form"/>
            <DxSearchPanel
                :visible="true"
                :width="300"
                placeholder="-   Поиск"
                :highlight-case-sensitive="true"
            />

        </DxDataGrid>


    </div>
</template>

<script>

    import CustomStore from 'devextreme/data/custom_store';
    import axios from 'axios';
    import {
        DxDataGrid,
        DxColumn,
        DxLookup,
        DxPaging,
        DxEditing,
        DxSearchPanel,
        DxFormItem
    } from 'devextreme-vue/data-grid';
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

    const storeTechnologies = new CustomStore({
        key: 'id',
        byKey: function (key) {
            return {id: key};
        },
        load: (loadOptions) => {
            return axios.get(`${url}/roadmaps/look-technologies`).then(response => {
                return response.data
            });
        },
    });


    export default {
        name: "DevGridTopicExamples",
        components: {DxDataGrid, DxColumn, DxLookup, DxPaging, DxEditing,DxFormItem, DxSearchPanel},
        props: {
            propsColumns: {
                type: Object,
                default: () => ({})
            },
            propsCaptions: {
                type: Object,
                default: () => ({})
            },
            topicMasterDetailData: {
                type: Object,
                default: () => ({})
            },
            topicId: {
                type: Number,
                default: null
            }
        },
        data() {
            return {
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

                        return fetch(`${url}/topic/${this.topicMasterDetailData.key.id}/examples`)
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
                        return axios.post(`${url}/topic/${this.topicMasterDetailData.key.id}/insert-examples`, values, {method: "POST"});//.then());
                    },
                    update: (key, values) => {
                        return axios.put(`${url}/topic/${this.topicMasterDetailData.key.id}/update-examples/` + encodeURIComponent(key.id), values, {method: "PUT"});//.then(handleErrors);
                    },
                    remove: (key) => {
                        return axios.delete(`${url}/topic/${this.topicMasterDetailData.key.id}/delete-examples/` + encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
                    }
                }),
                storeTechnologies,
                editButtons: ['insert', 'delete', 'edit'],
            };
        }


    }
</script>

<style scoped>
    h1 {
        text-align: center;
        color: #3DEBD3;

    }
</style>










