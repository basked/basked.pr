<template>
    <DxDataGrid
        :data-source="dataSource"
        :remote-operations="remoteOperations">
        <DxGroupPanel :visible="true"/>
        <DxGrouping :auto-expand-all="true"/>
        <DxPaging :page-size="10"/>
        <DxHeaderFilter :visible="true"/>
        <DxSearchPanel :visible="true"/>
        <DxFilterRow :visible="true"/>
        <DxFilterPanel :visible="true"/>
        <DxEditing
            :allow-updating="true"
            :allow-adding="true"
            :allow-deleting="true"
            mode="form"/>
        <DxColumn
            data-field='id'
            caption="id"/>
        <DxColumn
            data-field='name'
            caption="name"/>
        <DxColumn
            data-field='descr'
            caption="descr"/>
        <DxColumn
            data-field='id_bas'
            caption="types"
            data-type="number"
            :allow-grouping="true"
            :allow-editing="true"
        >
            <DxColumnLookup
                :data-source="storeTypes"
                value-expr="id"
                display-expr="name"
            />
        </DxColumn>
        <DxSummary>
            <DxGroupItem
                column="Id"
                summary-type="count"
            />
        </DxSummary>
    </DxDataGrid>
</template>

<script>
    import {
        DxDataGrid,
        DxField,
        DxColumn,
        DxFieldLookup,
        DxFilterRow,
        DxFilterPanel,
        DxRemoteOperations,
        DxSearchPanel,
        DxEditing,
        DxColumnLookup,
        DxGroupPanel,
        DxGrouping,
        DxPaging,
        DxHeaderFilter,
        DxGroupItem,
        DxSummary
    } from 'devextreme-vue/data-grid'


    import CustomStore from 'devextreme/data/custom_store';
    import DataSource from 'devextreme/data/data_source';
    import ArrayStore from 'devextreme/data/array_store';

    import axios from 'axios';

    const url = 'http://basked.pr/api/skill';

    function handleErrors(response) {
        if (!response.ok)
            throw Error(response.statusText);
        return response;
    }

    function isNotEmpty(value) {
        return value !== undefined && value !== null && value !== "";
    }

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
                console.log(params);
                params = params.slice(0, -1);

                return fetch(`${url}/test-dev-php-load/${params}`)
                    .then(handleErrors)
                    .then(response => response.json())
                    .then((result) => {
                        return {
                            data: result.data,
                            totalCount: result.totalCount
                        }
                    });
            },
            insert: (values) => {
                return axios.post(`${url}/test-dev-php-load`, values, {method: "POST"});//.then());
            },
            remove: (key) => {
                return axios.delete(`${url}/test-dev-php-load/` + encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
            },
            update: (key, values) => {

                return axios.put(`${url}/test-dev-php-load/` + encodeURIComponent(key.id), values, {method: "PUT"});//.then(handleErrors);
            },
            onUpdating: function (key, values) {
                console.log('onUpdating');
            },
            onInserted(v, k) {
                console.log('onInserted');
            },
            onUpdated: function (key, values) {
                console.log('onUpdated');
            },
            onRemoved: function (key) {
                console.log('onRemoved' + key)
            }
        })
    };

    export default {
        name: "testCustomStore",
        components: {
            DxDataGrid,
            DxRemoteOperations,
            DxDataGrid,
            DxField,
            DxColumn,
            DxFieldLookup,
            DxFilterRow,
            DxFilterPanel,
            DxSearchPanel,
            DxEditing,
            DxColumnLookup,
            DxGroupPanel,
            DxGrouping,
            DxPaging,
            DxHeaderFilter,
            DxGroupItem,
            DxSummary
        },
        data() {
            return {
                dataSource: gridDataSource,
                storeTypes: new CustomStore({
                        byKey: (key) => {
                            return key;
                        },
                        load: (param) => {
                            let s = '';
                            if (param.searchValue === null) {
                                s = `${url}/types/look-types`
                            } else {
                                s = `${url}/types/look-types/${param.searchValue}`
                            }
                            return axios.get(s).then(
                                (data) => {
                                    return data.data
                                }, () => {
                                }
                            );
                        }
                    }
                ),
                remoteOperations: {
                    filtering: true,
                    sorting: true,
                    summary: true,
                    paging: true,
                    grouping: true,
                    groupPaging: true,
                }
            }
        },
        mounted() {
            console.log(this.dataTypes)
        }
    }
</script>
