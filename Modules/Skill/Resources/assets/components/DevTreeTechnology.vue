<template>
    <div>
        <DxTreeList
            id="tree-list"
            :data-source="tasksData"
            :expanded-row-keys="[1, 2]"
            :show-row-lines="true"
            :show-borders="true"
            :column-auto-width="true"
            :word-wrap-enabled="true"
            key-expr="Task_ID"
            parent-id-expr="Task_Parent_ID"
            has-items-expr="Has_Items"
            @initNewRow="initNewRow($event)"
        >
            <DxRemoteOperations
                :filtering="true"
                :sorting="true"
                :grouping="true"
            />
            <DxSearchPanel :visible="true"/>
            <DxHeaderFilter :visible="true"/>
            <DxEditing
                :allow-adding="true"
                :allow-updating="true"
                :allow-deleting="true"
                mode="row"
            />
            <DxColumn
                :min-width="250"
                data-field="Task_Subject"
            >
                <DxRequiredRule/>
            </DxColumn>
            <DxColumn
                :min-width="120"
                data-field="Task_Assigned_Employee_ID"
                caption="Assigned"
            >
                <DxLookup
                    :data-source="employeesData"
                    value-expr="ID"
                    display-expr="Name"
                />
                <DxRequiredRule/>
            </DxColumn>
            <DxColumn
                :min-width="120"
                data-field="Task_Status"
                caption="Status"
            >
                <DxLookup :data-source="statusesData"/>
            </DxColumn>
            <DxColumn
                data-field="Task_Start_Date"
                caption="Start Date"
                data-type="date"
            />
            <DxColumn
                data-field="Task_Due_Date"
                caption="Due Date"
                data-type="date"
            />
        </DxTreeList>
    </div>
</template>
<script>
    import {
        DxTreeList,
        DxRemoteOperations,
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

    const treeDataSource = {
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

                return fetch(`${url}/technologies${params}`)
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
                return axios.post(`${url}/technologies`, values, {method: "POST"});//.then());
            },
            remove: (key) => {
                return axios.delete(`${url}/technologies/` + encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
            },
            update: (key, values) => {
                return axios.put(`${url}/technologies/` + encodeURIComponent(key.id), dataToUpdate(key, values), {method: "PUT"});//.then(handleErrors);
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
        name: "DevTreeTechnology",
        components: {
            DxTreeList,
            DxRemoteOperations,
            DxColumn,
            DxSearchPanel,
            DxHeaderFilter,
            DxEditing,
            DxRequiredRule,
            DxLookup
        },
        data() {
            return {
                dataSource : treeDataSource,
                // tasksData: AspNetData.createStore({
                //     key: 'Task_ID',
                //     loadUrl: `${url}/Tasks`,
                //     insertUrl: `${url}/InsertTask`,
                //     updateUrl: `${url}/UpdateTask`,
                //     deleteUrl: `${url}/DeleteTask`,
                //     onBeforeSend: function(method, ajaxOptions) {
                //         ajaxOptions.xhrFields = { withCredentials: true };
                //     }
                // }),
                // employeesData: AspNetData.createStore({
                //     key: 'ID',
                //     loadUrl: `${url}/TaskEmployees`
                // }),
                // statusesData: [
                //     'Not Started',
                //     'Need Assistance',
                //     'In Progress',
                //     'Deferred',
                //     'Completed'
                // ]
            };
        },
        methods: {
            initNewRow(e) {
                e.data.Task_Status = 'Not Started';
                e.data.Task_Start_Date = new Date();
                e.data.Task_Due_Date = new Date();
            }
        }
    };
</script>
<style scoped>
    #tree-list {
        max-height: 640px;
    }
</style>










