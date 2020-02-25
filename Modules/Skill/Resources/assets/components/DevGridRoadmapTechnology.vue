<template>
    <div id="dev-grid-roadmap-technology">
        <DxDataGrid
            :data-source="dataSource">
            <DxColumn
                data-field='id'
                caption="Технология"
                data-type="number"
                :allow-grouping="true"
                :allow-editing="true"
            >
                <DxLookup

                    :data-source="storeTechnologies"
                    value-expr="id"
                    display-expr="name"
                />
            </DxColumn>

            <DxColumn
                :width="210"
                :buttons="editButtons"
                type="buttons"
            />
            <DxEditing
                :allow-updating="true"
                :allow-adding="true"
                :allow-deleting="true"
                mode="batch"/>
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
        DxSearchPanel
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
        name: "DevGridRoadmapTechnology",
        components: {DxDataGrid, DxColumn, DxLookup, DxPaging, DxEditing, DxSearchPanel},
        props: {
            roadmapMasterDetailData: {
                type: Object,
                default: () => ({})
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

                        return fetch(`${url}/roadmaps/${this.roadmapMasterDetailData.key.id}/technologies`)
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
                        return axios.post(`${url}/roadmaps/${this.roadmapMasterDetailData.key.id}/insert-technologies`, values, {method: "POST"});//.then());
                    },
                    update: (key, values) => {
                        return axios.put(`${url}/roadmaps/${this.roadmapMasterDetailData.key.id}/update-technologies/`+ encodeURIComponent(key.id), values, {method: "PUT"});//.then(handleErrors);
                    },
                    remove: (key) => {
                        return axios.delete(`${url}/roadmaps/${this.roadmapMasterDetailData.key.id}/delete-technologies/`+ encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
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










