<template>
    <div class="dev-grid-topic-links">
        <DxToolbar>
            <DxItem
                :options="addButtonOptions"
                location="before"
                locate-in-menu="auto"
                widget="dxButton"
            />
            <DxItem
                :options="printButtonOptions"
                location="before"
                locate-in-menu="always"
                widget="dxButton"
            />
            <DxItem
                :options="settingsButtonOptions"
                location="before"
                locate-in-menu="always"
                widget="dxButton"
            />
        </DxToolbar>

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
            :width="500"
            data-field="url"
            cell-template="cell_url"/>
            <template #cell_url="{ data }">
                <a :href="data.value" target="_blank">{{data.value}}</a>
            </template>
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
    import DxToolbar, {DxItem} from 'devextreme-vue/toolbar';
    import notify from 'devextreme/ui/notify';
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

        name: "DevGridTopicLinks",
        components: {
            DxToolbar,
            DxItem,
            DxDataGrid,
            DxColumn,
            DxLookup,
            DxPaging,
            DxEditing,
            DxSearchPanel,
            DxFormItem
        },
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

                        return fetch(`${url}/topic/${this.topicMasterDetailData.key.id}/links`)
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
                        return axios.post(`${url}/topic/${this.topicMasterDetailData.key.id}/insert-links`, values, {method: "POST"});//.then());
                    },
                    update: (key, values) => {
                        return axios.put(`${url}/topic/${this.topicMasterDetailData.key.id}/update-links/` + encodeURIComponent(key.id), values, {method: "PUT"});//.then(handleErrors);
                    },
                    remove: (key) => {
                        return axios.delete(`${url}/topic/${this.topicMasterDetailData.key.id}/delete-links/` + encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
                    }
                }),
                storeTechnologies,
                editButtons: ['insert', 'delete', 'edit'],
                addButtonOptions: {
                    icon: 'plus',
                    onClick: () => {
                        notify('Add button has been clicked!');
                    }
                },

                printButtonOptions: {
                    text: 'Print',
                    onClick: () => {
                        notify('Print option has been clicked!');
                    }
                },
                settingsButtonOptions: {
                    text: 'Settings',
                    onClick: () => {
                        notify('Settings option has been clicked!');
                    }
                }
            }
        }
    }
</script>

<style scoped>
    .dx-toolbar {
        background-color: #3DEBD3;
    }
</style>
