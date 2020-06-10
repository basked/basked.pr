<template>
    <DxDataGrid
        :dataSource="dataSource"
        :allowSearch="true"

    >
        <DxColumn
            data-field='id'
            caption="id"/>
        <DxColumn
            data-field='name'
            caption="name"/>
        <DxColumn
            data-field='kind'
            caption="kind"/>

        <DxColumn
            data-field='type_id'
            caption="types"/>


        <DxColumn
            data-field='type_id'
            caption="types"
            data-type="number"
            :allow-grouping="true"
            :allow-editing="true"
        >
            <DxColumnLookup
                :data-source="dataSourseTypes"
                value-expr="id"
                display-expr="name"
            />
        </DxColumn>
        <DxEditing
            :allow-updating="true"
            :allow-deleting="true"
            :allow-adding="true"
            mode="row"
        />
    </DxDataGrid>
</template>

<script>
    const bboysArray = [
        {'id': 1, 'name': 'basket', 'kind': 'powermove', 'type_id': 1}, {
            'id': 2, 'name': 'sony', 'kind': 'style', 'type_id': 1},
        {'id': 3, 'name': 'ice', 'kind': 'powermove', 'type_id': 2},
        {'id': 4, 'name': 'hip', 'kind': 'style', 'type_id': 3}
    ];

    const typeArray = [{'id': 1, 'name': 'mover'}, {'id': 2, 'name': 'styler'}, {'id': 3, 'name': 'freeser'}];

    import ArrayStore from 'devextreme/data/array_store'
    import {
        DxDataGrid,
        DxField,
        DxColumn,
        DxFieldLookup,
        DxSearchPanel,
        DxEditing,
        DxColumnLookup
    } from 'devextreme-vue/data-grid'

    const storeTypes = new ArrayStore(typeArray);
    const store = new ArrayStore(
        {
            key: 'id',
            data: bboysArray,
            errorHandler: (error) => {
                console.log(error.message);
            },
            onPush: (changes) => {
                console.log(caches)
            },
            // Выполняеться после загрузки данных в хранилище
            onLoading: (loadOptions) => {
                console.log('onLoading');
                console.log(loadOptions);
            },
            // Выполняеться после загрузки данных в хранилище
            onLoaded: (loadOptions) => {
                console.log('onLoaded')
                console.log(loadOptions);
            },

            onInserting: (values) => {
                console.log('Добавляются данные');
            },

            onInserted: (values, key) => {
                console.log('Добавлены данные');
                console.log(key, values)
            },


            onModified() {
                console.log('MODIFIED')
                store.load().then((data) => {
                    console.log(data)

                })
            }


        });
    export default {
        name: "testArrayLayer",
        components: {
            DxDataGrid, DxSearchPanel, DxColumn, DxEditing, DxField, DxColumnLookup, DxFieldLookup
        },
        data() {
            return {
                dataSource: store,
                dataSourseTypes: typeArray
            }
        },
        beforeCreate() {
            console.log('beforeCreate')
        },

        mounted() {
            console.log('mounted')
            this.insertBBoys();
            /*this.queryBBoys();
            this.getBBoy(1);
            this.updateBBoy(8, {'name': 'XoXoL'});
            this.removeBBoy(9)*/
        },
        methods: {
            // test insert() method
            insertBBoys() {
                console.log('Test insert() method')
                store.insert({'id': 5, 'name': 'shake', 'kind': 'freezes'});
                store.insert({'id': 6, 'name': 'scope', 'kind': 'powermove'});
                store.insert({'id': 7, 'name': 'cap', 'kind': 'powermove'});
                store.insert({'id': 7, 'name': 'cap', 'kind': 'powermove'});
                store.insert({'id': 8, 'name': 'xoxoL', 'kind': 'freezes'});
                store.insert({'id': 9, 'name': 'EBANAT', 'kind': 'freezes'});
            },
            updateBBoy(key, updateData) {
                console.log('Test update() method')
                // update only field name
                store.update(key, updateData);

            },
            // delete bboy
            removeBBoy(bboy) {
                store.remove(bboy);
            },
            //test createQuery() method
            queryBBoys() {
                console.log('Test createQuery() method')
                const q = store.createQuery();
                console.log(q.select(['name', 'kind']).sortBy('name').groupBy('kind').toArray());
                console.log(q.select(['name', 'kind']).sortBy('kind', true).thenBy('name').toArray());
                console.log(q.select(['name', 'kind']).filter(['kind', 'contains', 'powermove']).sortBy('name').toArray());
            },
            //test  byKey() method
            getBBoy: (id) => {
                console.log('Test byKey() method')
                store.byKey(id).then((dataItems) => {
                    console.log(dataItems)
                }, (error) => {
                    console.log(error)
                })
            }
        }
    }
</script>

<style scoped>

</style>
