<template>
    <div id="country-attributes-tab">
      <DxDataGrid :data-source="dataSource">
          <DxColumn data-field="name" caption="Атрибут"/>
          <DxColumn data-field="pivot.val" caption="Значение"/>
      </DxDataGrid>
    </div>
</template>

<script>
    import 'devextreme/dist/css/dx.material.orange.dark.compact.css';
 //   import 'devextreme/dist/css/dx.darkmoon.compact.css';
    import CustomStore from 'devextreme/data/custom_store';
    import axios from 'axios';
    import {
        DxDataGrid,
        DxColumn,
        DxPaging
    } from 'devextreme-vue/data-grid';
    import 'whatwg-fetch';
    function handleErrors(response) {
        if (!response.ok)
            throw Error(response.statusText);
        return response;
    }

    function isNotEmpty(value) {
        return value !== undefined && value !== null && value !== "";
    }

    export default {
        name: "CountryAttributesTab",
        components: {DxDataGrid,DxColumn,DxPaging},
        props: {
            countryId: {
                type: Number,
                default: null
            }
        },
        data() {
            return {
                 dataSource:  new CustomStore({
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

                         return fetch(`/api/directory/countries/${this.countryId}/attributes`)
                         // return fetch(`/api/directory/country${params}`)
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
                         return axios.post(`/api/directory/country`, values, {method: "POST"});//.then());
                     },
                     remove: (key) => {
                         return axios.delete(`/api/directory/country/` + encodeURIComponent(key.id), {method: "DELETE"});//.then(handleErrors);
                     },
                     update: (key, values) => {
                         return axios.put(`/api/directory/country/` + encodeURIComponent(key.id), values, {method: "PUT"});//.then(handleErrors);
                     }
                 })
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
