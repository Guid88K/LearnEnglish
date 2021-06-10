<template>
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-row-reverse bd-highlight" v-if="role === 'admin'">
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

                            <button v-if="role === 'admin'" @click="editLessons(lessons.id)"
                                    class="btn btn-primary  ms-2">Редагувати
                            </button>
                            <button v-if="role === 'admin'" @click="deleteLessons(lessons.id)"
                                    class="btn btn-primary  ms-2">Видалити
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


    name: "GrammarComponent",
    data() {
        return {
            grammar: [],
            role: document
                .querySelector("meta[name='role']")
                .getAttribute("content"),
            domain: document
                .querySelector("meta[name='domain']")
                .getAttribute("content"),
        }
    },
    mounted() {
        this.getGrammar();
    },
    methods: {
        async getGrammar() {
            const grammarData = await axios.get('/api/grammar/');
            console.log(grammarData.data.data);
            this.grammar = grammarData.data.data;
            this.sortElement(this.grammar)
        },
        showLessons(item) {
            this.$router.push({name: 'lessons', params: {id: item}})
        },
        editLessons(item) {
            this.$router.push({name: 'editLessons', params: {id: item}})
        },
        sortElement(array) {
            array.sort(function (a, b) {

                return b.id - a.id//sort by id

            })
        },
        async deleteLessons(items) {
            await axios.delete("/api/grammar/" + items);
            this.grammar = this.grammar.filter((word) => word.id !== items);
        }
    }
}
</script>

<style scoped>

</style>
