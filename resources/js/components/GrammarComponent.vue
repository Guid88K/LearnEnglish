<template>
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-row-reverse bd-highlight">
                <button class="btn btn-primary m-2" @click="$router.push('lessons_add')">Добавити нову тему
                </button>
            </div>
        </div>


        <div class="row ">
            <div class="mt-2" v-for="lessons in grammar" :key="lessons">
                <div class="card">
                    <div class="card-header">
                        {{ lessons.category_topics }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ lessons.name_topics }}</h5>
                        <p class="card-text" v-html="lessons.content_topics.substring(0,100)+'...'"></p>

                        <button @click="showLessons(lessons.id)"
                                class="btn btn-primary">Читати повністю
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {

    props: ['lessons_id'],
    name: "GrammarComponent",
    data() {
        return {
            grammar: [],

        }
    },
    mounted() {
        this.getGrammar();
    },
    methods: {
        async getGrammar() {
            const grammarData = await axios.get('http://127.0.0.1:8000/api/grammar/');
            console.log(grammarData.data.data);
            this.grammar = grammarData.data.data;
            this.sortElement(this.grammar)
        },
        showLessons(item) {
            this.$router.push({name: 'lessons', params: {id: item}})
        },
        sortElement(array) {
            array.sort(function (a, b) {

                return b.id - a.id//sort by id

            })
        },
    }
}
</script>

<style scoped>

</style>
