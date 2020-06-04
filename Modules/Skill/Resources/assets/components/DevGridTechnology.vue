<template>

    <div id="data-grid-technology">
        <DxDataGrid
            :data-source="dataSource"
            :remote-operations="remoteOperations"
            :columns="columns"
            :show-borders="true"
            :allow-column-resizing="true"
            :allow-column-reordering="true"
            @initialized="saveGridInstance"
            @rowInserted="rowIns"
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
                data-field='type_id'
                caption="Тип"
                data-type="number"
                :allow-grouping="true"
                :allow-editing="true"
            >
                <DxLookup
                    :data-source="arrayLookTypes"
                    value-expr="id"
                    display-expr="name"
                />
            </DxColumn>

            <
            <DxColumn
                data-field='technology_id'
                caption="Категория"

                :allow-grouping="true"
                :allow-editing="true"
            >
                <DxLookup
                    :data-source="storeTechnology"
                    value-expr="id"
                    display-expr="name"
                />
            </DxColumn>
            <DxColumn
                data-field='technology_id'
                caption="Категория2"
                data-type="string"
                :allow-grouping="true"
                :allow-editing="true"
            >
                <DxLookup
                    :data-source="arrayLookTechnology"
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
    import 'devextreme/dist/css/dx.common.css';
    import 'devextreme/dist/css/dx.darkmoon.css';
    import "font-awesome/css/font-awesome.css";
    import {DxCheckBox, DxSelectBox} from 'devextreme-vue';
    import axios from 'axios';
    import {
        DxDataGrid,
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

    // сравнивает страрые знчения и обновленные - записывает пересечение
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

    const storeTechnology = new CustomStore({
        key: 'id',
        byKey: function (key) {
            return {id: key};
        },
        load: (loadOptions) => {
            return axios.get(`${url}/technologies/look-technologies`).then(response => {
                return response.data
            });
        },
    });


    const gridDataSource = {
        store: new CustomStore({
            load: (loadOptions) => {
                console.log(loadOptions)
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
        name: "DevGridTechnology",
        components: {
            DxSwitch,
            DxDataGrid,
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
                storeType,
                storeTechnology,
                dataSource: gridDataSource,
                arrayLookTechnology: [],
                arrayLookTypes: [],
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
                editButtons: ['delete', '|', {
                    hint: 'Reset type',
                    icon: 'fa fa-minus-circle',
                    // visible: this.isCloneIconVisible,
                    onClick: this.resetTypeClick
                }, '|',
                    {
                        hint: 'Reset category',
                        icon: 'fa fa-minus-square',
                        // visible: this.isCloneIconVisible,
                        onClick: this.resetCategoryClick
                    }
                ],

            }
        },
        mounted() {
            this.getLookUpTechnologies()
          this.getLookUpTypes()
            /*  axios.get(`${url}/technologies/look-technologies`).then(response => {
                  this.arrayTech = response.data.data
                   console.log(this.arrayTech);
              });*/
        },
        methods: {

            // Переводим в массив для корректной фильтрации в dxLookUp
            getLookUpTechnologies() {
                console.log('GET TECHNOLOGIES')
                axios.get(`${url}/technologies/look-technologies`).then(response => {
                    this.arrayLookTechnology = response.data.data
                });
            },

            getLookUpTypes() {
                axios.get(`${url}/types/look-types`).then(response => {
                    this.arrayLookTypes = response.data.data
                })
            },

            rowIns: function (e) {
                console.log("ROWINSERTED " + e)
                this.getLookUpTechnologies()
                this.getLookUpTypes()
            },


            saveGridInstance: function (e) {
                this.dataGridInstance = e.component;
            },

            refresh: function () {
                this.dataGridInstance.refresh();
                this.dataGridInstance.getLookUpTechnologies()
            },

            // Обнуляем тип
            resetTypeClick(e) {
                return axios.put(`${url}/technologies/reset-type/` + encodeURIComponent(e.row.key.id), {method: "PUT"}).then(
                    // обновляем таблицу
                    this.refresh
                );

            },
            // Обнуляем категорию
            resetCategoryClick(e) {
                return axios.put(`${url}/technologies/reset-category/` + encodeURIComponent(e.row.key.id), {method: "PUT"}).then(
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
