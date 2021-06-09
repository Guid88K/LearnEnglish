<template>
    <div class="div">


        <div class="jumbotron m-4">
            <h1 class="display-4 text-center">{{ nameTopics }}</h1>
            <p class="lead text-center">{{categoryTopics }}</p>
            <hr class="my-4">
            <p v-html="contentTopics"></p>
            <p class="float-end">
                <a class="btn btn-primary " @click="$router.back()" role="button">Назад</a>
            </p>
        </div>


    </div>
</template>

<script>

import axios from "axios";

export default {
    data() {
        return {
            nameTopics: '',
            categoryTopics: '',
            contentTopics: ''
        }
    },
    mounted() {
        this.getLesson();
    },
    methods: {
        async getLesson() {
            const lesson = await axios.get('http://127.0.0.1:8000/api/grammar/' + this.$route.params.id);
            this.nameTopics = lesson.data.data.name_topics;
            this.categoryTopics = lesson.data.data.category_topics;
            this.contentTopics = lesson.data.data.content_topics;
        }
    }

}
</script>

<style scoped>

</style>
