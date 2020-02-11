<template>
    <div id="country-attributes-tab">
        <h1> CountryAttributes</h1>
        <ul>
            <li>Население: 148 000 000</li>
            <li>Площадь: 580 000 000</li>
            <li>Столица: Москва</li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "CountryAttributesTab",
        props: {
            countryId: {
                type: Number,
                default: null
            }
        },
    }
</script>

<style scoped>
    h1 {
       text-align: center;
        color: #3DEBD3;

    }
</style>
