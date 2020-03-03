<template>
    <div class="dev-grid-topic-links">
        <DxToolbar>
            <DxItem
                :options="addButtonOptions"
                location="before"
                locate-in-menu="auto"
                widget="dxButton"
            />
            <DxItem
                :options="printButtonOptions"
                location="before"
                locate-in-menu="always"
                widget="dxButton"
            />
            <DxItem
                :options="settingsButtonOptions"
                location="before"
                locate-in-menu="always"
                widget="dxButton"
            />
        </DxToolbar>
    </div>
</template>

<script>
    import DxToolbar, {DxItem} from 'devextreme-vue/toolbar';
    import notify from 'devextreme/ui/notify';
    export default {

        name: "DevGridTopicLinks",
        components: {
            DxToolbar,
            DxItem
        },
        props: {
            topicId: {
                type: Number,
                default: null
            }
        },
        data() {
            return {
                addButtonOptions: {
                    icon: 'plus',
                    onClick: () => {
                        notify('Add button has been clicked!');
                    }
                },

                printButtonOptions: {
                    text: 'Print',
                    onClick: () => {
                        notify('Print option has been clicked!');
                    }
                },
                settingsButtonOptions: {
                    text: 'Settings',
                    onClick: () => {
                        notify('Settings option has been clicked!');
                    }
                }
            }
        }
    }
</script>

<style scoped>
    .dx-toolbar
    {
      background-color: #3DEBD3;
    }
</style>
