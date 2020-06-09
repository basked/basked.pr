<template>
    <div class="testDevExtreme">
        <DxDataGrid
            :data-source="dataSource"
            :remote-operations="remoteOperations"
        >
            <DxColumn
                data-field='id'
                caption="id"/>
            <DxColumn
                data-field='name'
                caption="name"/>

            <DxColumn
                data-field="id_bas"
                caption="id_bas"
            >
                <DxLookup
                    :data-source="apiLookup"
                    value-expr="id"
                    display-expr="descr"
                />
            </DxColumn>

            <DxEditing
                :allow-updating="true"
                :allow-adding="true"
                :allow-deleting="true"
                mode="batch"/>
            <DxSearchPanel
                :visible="true"

            />
        </DxDataGrid>
    </div>
</template>

<script>

    import {DxDataGrid, DxColumn, DxEditing, DxSearchPanel, DxLookup} from 'devextreme-vue/data-grid'
    import DataSource from 'devextreme/data/data_source'
    import CustomStore from "devextreme/data/custom_store";
    import axios from 'axios'

    const url = 'http://basked.pr/api/skill';
    export default {
        name: "TestDevExtreme",
        components: {
            DxDataGrid,
            DxColumn,
            DxLookup,
            DxEditing,
            DxSearchPanel
        },
        data() {
            return {
                dataSource: null,
                arrayDataSource: [],
                apiDataSource: null,
                apiLookup: null,
                remoteOperations: {
                    filtering: true,
                    sorting: true,
                    summary: true,
                    paging: true,
                    grouping: true,
                    groupPaging: true,
                },
            }
        },
        beforeCreate() {
            console.log("BeforeCreate component")

        },
        created() {
            console.log("Created component");

        },
        mounted() {
            console.log("Mounted component");
            // Масив
            this.arrayDataSource = [
                {'id': 1, 'name': 'basket'},
                {'id': 2, 'name': 'teksab'},
                {'id': 3, 'name': 'bas'}
            ];
            //Api
            this.apiDataSource = new DataSource(`${url}/test-list-links`);
            this.apiLookup = new CustomStore({
                byKey: (key) => {
                    axios.get(`${url}/test-search-lookup/${key}`).then((response) => {
                        console.log( response.data);
                        return response.data
                    })

                },
                load: (loadOptions) => {
                    let dt = [{'id': 1, 'descr': null}];
                    var respData = null;
                    axios.get(`${url}/test-search-lookup/${loadOptions.searchValue}`).then((response) => {
                        respData=response.data;
                        dt[0].descr=respData;
                        this.apiLookup=dt;
                    })
                    console.log( this.apiLookup);
                },
                insert: (values) => {
                    // ...
                },
                update: (key, values) => {
                    // ...
                },
                remove: (key) => {
                    // ...
                }
            });
            this.dataSource = this.apiDataSource;
        },
        methods: {}
    }
</script>

<style scoped>

</style>
