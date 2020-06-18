<template>
    <DxGantt
        :task-list-width="500"
        :height="700"
        scale-type="weeks"
    >

        <DxTasks :data-source="tasks"/>
        <DxDependencies :data-source="dependencies"/>
        <DxResources :data-source="resources"/>
        <DxResourceAssignments :data-source="resourceAssignments"/>

        <DxToolbar>
            <DxItem name="undo"/>
            <DxItem name="redo"/>
            <DxItem name="separator"/>
            <DxItem name="collapseAll"/>
            <DxItem name="expandAll"/>
            <DxItem name="separator"/>
            <DxItem name="addTask"/>
            <DxItem name="deleteTask"/>
            <DxItem name="separator"/>
            <DxItem name="zoomIn"/>
            <DxItem name="zoomOut"/>
        </DxToolbar>

        <DxEditing :enabled="true"/>
        <DxValidation :autoUpdateParentTasks="true"/>

        <DxColumn
            :width="300"
            data-field="title"
            caption="Subject"
        />
        <DxColumn
            data-field="start"
            caption="Start Date"
        />
        <DxColumn
            data-field="end"
            caption="End Date"
        />
    </DxGantt>
</template>
<script>
    import 'devextreme/dist/css/dx.common.css';
    import 'devextreme/dist/css/dx.darkmoon.compact.css';
    import 'devexpress-gantt/dist/dx-gantt.css';

    import {
        DxGantt,
        DxTasks,
        DxDependencies,
        DxResources,
        DxResourceAssignments,
        DxColumn,
        DxEditing,
        DxValidation,
        DxToolbar,
        DxItem
    } from 'devextreme-vue/gantt';
    import 'devextreme-vue/diagram';

    import DataSource from 'devextreme/data/data_source';
    import CustomStore from 'devextreme/data/custom_store';
    import axios from 'axios';

    const url = 'http://basked.pr/api/skill';
    const ds_tasks = {
        store: new CustomStore({
                key: 'id',
                load: (loadOptions) => {
                    return axios.get(`${url}/test-task`)
                },
                insert: (values) => {
                    console.log(values)
                },
                update: (id, values) => {
                    console.log(id, values)
                },
                remove: (id) => {
                    console.log(id)
                }
            }
        )
    };

    const ds_dependencies = {
        store: new CustomStore({
            key: 'id',
            load: (loadOptions) => {
                return axios.get(`${url}/test-dependency`)
            },
            insert: (values) => {
                console.log(values)
            },
            update: (id, values) => {
                console.log(id, values)
            },
            remove: (id) => {
                console.log(id)
            }
        })
    };
    const ds_resource_assignment = {
        store: new CustomStore({
            key: 'id',
            load: (loadOptions) => {
                return axios.get(`${url}/test-resource-assignment`)
            }
            ,
            insert: (values) => {
                console.log(values)
            },
            update: (id, values) => {
                console.log(id, values)
            },
            remove: (id) => {
                console.log(id)
            }
        })
    };

    const ds_resources = {
        store: new CustomStore({
            key: 'id',
            load: (loadOptions) => {
                return axios.get(`${url}/test-resource`)
            }
            ,
            insert: (values) => {
                console.log(values)
            },
            update: (id, values) => {
                console.log(id, values)
            },
            remove: (id) => {
                console.log(id)
            }
        })
    };
    // import {
    //     tasks,
    //     dependencies,
    //     resources,
    //     resourceAssignments
    // } from './data.js';

    export default {
        name: "DevGantt",
        components: {
            DxGantt,
            DxTasks,
            DxDependencies,
            DxResources,
            DxResourceAssignments,
            DxColumn,
            DxEditing,
            DxValidation,
            DxToolbar,
            DxItem
        },
        data() {
            return {
                tasks: ds_tasks,
                dependencies: ds_dependencies,
                resources: ds_resources,
                resourceAssignments: ds_resource_assignment
            };
        }
    };
</script>
<style>
    #gantt {
        height: 700px;
    }
</style>
