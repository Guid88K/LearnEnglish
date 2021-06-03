<template>
    <div>

        <button @click="getAllIrregularWord" class="btn btn-primary m-2">Загрузити</button>

        <table v-html="allIrregularWord">

        </table>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "IrregularVerbsComponent",

    data() {
        return {
            allIrregularWord: '',
        }
    },
    methods: {
        async getAllIrregularWord() {
            const word = await axios.get('http://127.0.0.1:8000/api/irregular_word');
            console.log(word.data);
            this.allIrregularWord = word.data;
        }
    }
}
</script>

<style scoped>

</style>
