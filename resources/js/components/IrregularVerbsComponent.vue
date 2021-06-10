<template>
    <div>

        <button @click="getAllIrregularWord" class="btn btn-primary m-2">Загрузити</button>


        <table v-for="all in allIrregularWord">
            <text v-html="all"></text>
        </table>

        <div v-html="allIrregularWord"></div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "IrregularVerbsComponent",

    data() {
        return {
            allIrregularWord: [],
        }
    },
    methods: {
        async getAllIrregularWord() {
            const word = await axios.get('/api/irregular_word');

            this.allIrregularWord = word.data;
            console.log(this.allIrregularWord);
        }
    }
}
</script>

<style scoped>

</style>
