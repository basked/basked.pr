<template>

    <div class="CountryAttributesTab">
        <table>
            <td>
                <tr>
                    <div class="country-flag">
                        <img :src="img_flag"/>
                    </div>
                </tr>
                <tr>
                    <div class="country-descr">
                        <h4>{{descr}}</h4>
                    </div>
                </tr>

            </td>
        </table>
    </div>
</template>

<script>
    import {DxForm} from 'devextreme-vue/form';
    import CustomStore from "devextreme/data/custom_store";
    import {DxImage} from 'devextreme-vue/range-selector';
    import axios from "axios";

    export default {
        name: "CountryDetailsTab",
        components: {DxForm, DxImage},
        props: {
            countryId: {
                type: Number,
                default: null
            }
        },
        data() {
            return {
                img_flag: null,
                descr: null
            };
        },
        methods: {
            getDataDetails() {
                return axios.get(`http://basked.pr/api/directory/countries/${this.countryId}/details`).then(response => (
                    this.img_flag = response.data.data.img_flag,
                        this.descr = response.data.data.descr
                ))
            }
        },
        mounted() {
            this.getDataDetails()
        }
    };
</script>

<style scoped>
    .CountryAttributesTab {
        margin: 10px;
        display: inline-block

    }

    .country-flag {
        margin-top: 10px;
        width: 50%;
        padding: 10px;
    }

    .country-descr {
        margin-top: 10px;

        word-wrap: break-word; /* Перенос слов */
        white-space: normal;
    }

</style>

