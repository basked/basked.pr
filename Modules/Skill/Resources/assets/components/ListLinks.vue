<template>
    <div class="test_list_links">
        <h1>TEST DxLink</h1>
        <div class="list-container">
            <DxList
                :data-source="arrayData"
                height="600"
                selection-mode="multiple"
                page-load-mode="scrollBottom"
                :search-enabled="true"
                :search-mode="searchMode"
                search-expr="Name"
            >
                <template #item="{ data: item }">
                 <BlockCode :prop-code="item.name"/>
                </template>
            </DxList>
        </div>
    </div>
</template>

<script>
    import DxList from "devextreme-vue/list";
    import axios from 'axios';
    import CustomStore from "devextreme/data/custom_store";
    import DataSource from 'devextreme/data/data_source';
    import BlockCode from "./BlockCode.vue"

    const url = 'http://basked.pr/api/skill';


    export default {
        name: "ListLinks",
        components: {
            BlockCode,
            DxList
        },
        props: {
            propsList: {
                type: String,
                default: () => ({})
            }
        },
        data() {
            return {
                arrayData: [],
                searchMode: 'contains',
                // dataSource1 : new DevExpress.data.DataSource({
                //     store: {
                //         type: "array",
                //         key: "id",
                //         data:  [
                //             { id: 1, name: "Item 1" }
                //         ]
                //     }
                // })
            }
        },
        mounted() {
            this.arrayData = JSON.parse(this.propsList);
            console.log(this._data);
            this.updateLookUpTechnologies();
            // console.log(this.arrayData[0].name)
        },
        methods:{
            updateLookUpTechnologies() {
                axios.get(`${url}/test-list-links`).then(response => {
                     this.arrayData = response.data.data
                });
            }
        }
    }
</script>

<style scoped>

</style>
