<template>
    <DxDiagram
        id="diagram"
        ref="diagram"
    >
        <DxContextMenu
            :enabled="true"
            :commands="['bringToFront', 'sendToBack' , 'lock' , 'unlock' ]"
        />
        <DxPropertiesPanel
            :enabled="true"
            :collapsible="false"
        >
            <DxGroup :commands="['units']"/>
            <DxGroup :commands="['pageSize', 'pageOrientation' , 'pageColor' ]"/>
        </DxPropertiesPanel>
        <DxToolbar
            :visible="true"
            :commands="['undo', 'redo' , 'separator' , 'fontName' , 'fontSize' , 'separator' , 'bold' , 'italic' , 'underline' , 'separator' , 'fontColor' , 'lineColor' , 'fillColor' , 'separator' ]"
        />
        <DxToolbox :visible="true">
            <DxGroup
                :category="'general'"
                :title="'General'"
            />
            <DxGroup
                :category="'flowchart'"
                :title="'Flowchart'"
                :expanded="true"
            />
        </DxToolbox>
    </DxDiagram>
</template>
<script>
    import { DxDiagram, DxContextMenu, DxPropertiesPanel, DxGroup, DxToolbar, DxToolbox } from 'devextreme-vue/diagram';
    import 'whatwg-fetch';

    export default {
        components: {
            DxDiagram, DxContextMenu, DxPropertiesPanel, DxGroup, DxToolbar, DxToolbox
        },
        mounted() {
            var diagram = this.$refs['diagram'].instance;
            fetch('http://basked.pr/js/data_tree.json')
                .then(function(response) {
                    return response.json();
                })
                .then(function(json) {
                    diagram.import(JSON.stringify(json));
                })
                .catch(function() {
                    throw 'Data Loading Error';
                });
        }
    };
</script>
<style scoped>
    #diagram {
        height: 900px;
    }
</style>
