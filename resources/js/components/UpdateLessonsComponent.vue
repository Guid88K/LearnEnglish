<template>
    <div class="div">
        <div class="row p-2">
            <div class="col-1"></div>
            <div class="col-10 border">

                <form @submit.prevent="updateLessons" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label text-danger h4">{{ error }}</label>

                    </div>
                    <div class="mb-3">
                        <label for="topic" class="form-label">Назва теми</label>
                        <input type="text" v-model="name_lessons" class="form-control" id="topic"
                               placeholder="Назва теми">
                    </div>
                    <div class="mb-3">
                        <label for="category_topic" class="form-label">Категорія теми</label>
                        <select class="form-select" v-model="category_lessons" id="category_topic"
                                aria-label="Категорія теми">
                            <option selected>Вибрати категорыю</option>
                            <option value="Дієслово">Дієслово</option>
                            <option value="Часи дієслова">Часи дієслова</option>
                            <option value="Початківцям">Початківцям</option>
                            <option value="Правопис">Правопис</option>
                            <option value="Речення">Речення</option>
                            <option value="Словотворення">Словотворення</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <editor
                            api-key="dkiqxal9flzf8w4wwyti1mt3zyap80tqaknilocobvi4rjcy"
                            initialValue="<p>Initial editor content</p>"
                            v-model="content_lessons"
                            :init="{
                          height: 500,
                          menubar: false,
                          plugins: [
                            'advlist autolink lists link image charmap',
                            'searchreplace visualblocks code fullscreen',
                            'print preview anchor insertdatetime media',
                            'paste code help wordcount table'
                          ],
                          toolbar:
                            'undo redo | formatselect | bold italic | \
                            alignleft aligncenter alignright | \
                            bullist numlist outdent indent | help'
                        }"
                        >
                        </editor>
                    </div>

                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </form>
            </div>
            <div class="col-1"></div>
        </div>

    </div>
</template>

<script>

import Editor from '@tinymce/tinymce-vue';
import axios from "axios";

export default {
    components: {
        editor: Editor
    },
    name: "UpdateLessonsComponent",
    data() {
        return {
            name_lessons: '',
            category_lessons: '',
            content_lessons: '',
            error: ''
        }
    },
    mounted() {
        this.getLesson();
    },
    methods: {
        async getLesson() {
            const lesson = await axios.get('/api/grammar/' + this.$route.params.id);
            this.name_lessons = lesson.data.data.name_topics;
            this.category_lessons = lesson.data.data.category_topics;
            this.content_lessons = lesson.data.data.content_topics;
        },
        async updateLessons() {
            if (this.name_lessons === '') {
                this.error = 'Введіть назву';
            } else if (this.category_lessons === '') {
                this.error = 'Введіть категорію';
            } else if (this.content_lessons === '') {
                this.error = 'Введіть контент';
            } else {
                this.error = '';
                const response = axios.put('/api/grammar/' + this.$route.params.id, {
                    name_topics: this.name_lessons,
                    category_topics: this.category_lessons,
                    content_topics: this.content_lessons
                });

                this.$router.back();
                console.log(response)
            }

        }
    }
}
</script>

<style scoped>

</style>
