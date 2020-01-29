<template>
    <DxDiagram
        id="diagram"
        ref="diagram"
        @onItemClick="okClicked"
        @itemClick="okClicked"


    >
        <DxNodes
            :data-source="orgItemsDataSource"
            :image-url-expr="'picture'"
        >
            <DxAutoLayout :orientation="'horizontal'"/>
        </DxNodes>
        <DxEdges :data-source="orgLinksDataSource"/>
        <DxToolbox>
            <DxGroup
                :category="'general'"
                :title="'General'"
            />
            <DxGroup
                :category="'orgChart'"
                :title="'Organizational Chart'"
                :expanded="true"
            />
        </DxToolbox>
    </DxDiagram>
</template>
<script>
    import { DxDiagram, DxNodes, DxAutoLayout, DxEdges, DxToolbox, DxGroup } from 'devextreme-vue/diagram';
    import 'devextreme/dist/css/dx.common.css';
    import 'devextreme/dist/css/dx.darkmoon.compact.css';
    // import 'devextreme/dist/css/dx.diagram.css';

    import ArrayStore from 'devextreme/data/array_store';
    import service from './data.js';

    export default {
        components: {
            DxDiagram, DxNodes, DxAutoLayout, DxEdges, DxToolbox, DxGroup
        },
        data() {
            return {
                orgItemsDataSource: new ArrayStore({
                    key: 'this',
                    data: service.getOrgItems()
                }),
                orgLinksDataSource: new ArrayStore({
                    key: 'this',
                    data: service.getOrgLinks(),
                    texts: ["65"],
                })
            };
        },
        methods:{

            okClicked: function(e) {
                console.log(e);
            }
        }
    };
</script>
<style scoped>
    #diagram {
        height: 900px;
    }
</style>
