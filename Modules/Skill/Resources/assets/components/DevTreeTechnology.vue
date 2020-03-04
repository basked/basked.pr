<template>
    <div>
        <DxTreeList
            id="tree-list"
            :data-source="dataSource"
            :show-row-lines="true"
            :show-borders="true"
            :column-auto-width="true"
            :word-wrap-enabled="true"
            key-expr="id"
            parent-id-expr="technology_id"
            has-items-expr="true"
            :focusedRowEnabled="true"
            @initNewRow="initNewRow($event)"
            @FocusedRowChanged="onFocusedRowChanged"
        >
            <!--            <DxRemoteOperations-->
            <!--                :filtering="true"-->
            <!--                :sorting="true"-->
            <!--                :grouping="true"-->
            <!--            />-->
            <DxSearchPanel :visible="true"/>
            <DxHeaderFilter :visible="true"/>
            <DxEditing
                :allow-adding="true"
                :allow-updating="true"
                :allow-deleting="true"
                mode="row"

            />
            <DxSelection
                :recursive="true"
                mode="multiple"
            />

            <DxColumn
                data-field="name"
            />

            <DxColumn
                :width="100"
                :allow-sorting="false"
                data-field="name"
                caption="Link"
                cell-template="cellTemplate"
            />
            <DxColumn
                data-field='type_id'
                caption="Тип"
                data-type="number"
                :allow-grouping="true"
                :allow-editing="true"
            >
                <DxLookup
                    :data-source="storeType"
                    value-expr="id"
                    display-expr="name"
                />
                <DxRequiredRule/>
            </DxColumn>

            <DxColumn
                :width="210"
                :buttons="editButtons"
                type="buttons"
            >
            </DxColumn>
            <template #cellTemplate="cell">
                <a href="http://basked.pro/">basked pro</a>
            </template>
        </DxTreeList>
    </div>
</template>
<script>


    import {
        DxTreeList,
        DxSelection,
        DxColumn,
        DxSearchPanel,
        DxHeaderFilter,
        DxEditing,
        DxRequiredRule,
        DxLookup
    } from 'devextreme-vue/tree-list';
    import CustomStore from "devextreme/data/custom_store";
    import axios from "axios";

    const url = 'http://basked.pr/api/skill';
    const url_href = 'http://basked.pr/skill';


    function handleErrors(response) {
        if (!response.ok)
            throw Error(response.statusText);
        return response;
    }

    function isNotEmpty(value) {
        return value !== undefined && value !== null && value !== "";
    }

    function dataToUpdate(key, values) {
        let res = {};
        for (let k in key) {
            if (k in values) {
                res[k] = values[k]
            } else {
                res[k] = key[k]
            }
        }
        return res;
    }

    const treeDataSource = {
        store: new CustomStore({
            key: 'id',
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

                return fetch(`${url}/technologies/print-tree-data${params}`)
                    .then(handleErrors)
                    .then(response => response.json())
                    .then((result) => {
                        console.log(result)
                        return {
                            // key: result.data.id,
                            data: result.data,
                            // totalCount: result.totalCount,
                            // summary: result.summary,
                            // groupCount: result.groupCount
                        }
                    });
            },
            insert: (values) => {
                return axios.post(`${url}/technologies`, values, {method: "POST"});//.then());
            },
            remove: (key) => {
                return axios.delete(`${url}/technologies/` + encodeURIComponent(key), {method: "DELETE"});//.then(handleErrors);
            },

            update: (key, values) => {
                return fetch(`${url}/technologies/${encodeURIComponent(key)}`, {
                    method: "PUT",
                    body: JSON.stringify(values),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(handleErrors);
            } ,


            // update: (key, values) => {
            //     return axios.put(`${url}/technologies/` + encodeURIComponent(key), dataToUpdate(values, values), {method: "PUT"});//.then(handleErrors);
            // },
            onUpdating: function (key, values) {
                console.log(key, values);
                console.log('onUpdating');
            },
            onUpdated: function (key, values) {
                console.log(key, values);
                console.log('onUpdated');
            }
        })
    };
    const storeType = new CustomStore({
        key: 'id',
        byKey: function (key) {
            return {id: key};
        },
        load: (loadOptions) => {
            return axios.get(`${url}/types/look-types`).then(response => {
                return response.data
            });
        }
    });


    export default {
        name: "DevTreeTechnology",
        components: {
            DxTreeList,
            DxSelection,
            DxColumn,
            DxSearchPanel,
            DxHeaderFilter,
            DxEditing,
            DxRequiredRule,
            DxLookup
        },
        data() {
            return {
                storeType,
                dataSource: treeDataSource,
                technology_id:Number,
                editButtons: ['delete','edit', '|', {
                    hint: 'Go to topic',
                    icon: 'fa fa-list',
                    // visible: this.isCloneIconVisible,
                    onClick: this.goToTopics
                },
                ],
            };
        },
        methods: {
            initNewRow(e) {
                console.log(e)
                // e.data.Task_Status = 'Not Started';
                // e.data.Task_Start_Date = new Date();
                // e.data.Task_Due_Date = new Date();
            },
            onFocusedRowChanged(e){
                this.technology_id=e.row.data.id;
                console.log('onFocusedRowChanged',e.row.data)
            },
            goToTopics(){

                location.href = `${url_href}/technology/${this.technology_id}/topics`;
            }
        }
    };
</script>
<style scoped>
    #tree-list {
        max-height: 640px;
    }
</style>










