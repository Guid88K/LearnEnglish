<template>
    <div>
        <div >
            <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#addWord"
                class="btn btn-primary m-2 "
            >
                Добавити слова
            </button>
            <div
                class="modal fade"
                id="addWord"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Добавити слова
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <form
                            ref="form"
                            @submit.prevent="addWord"
                            enctype="multipart/form-data"
                        >
                            <div class="modal-body">
                                <app-input
                                    label="Англійське слово"
                                    v-model:value="word_eng"
                                ></app-input>
                                <!-- <div class="mb-3">
                                    <label for="word_eng" class="form-label"
                                        >Англійське слово</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="word_eng"
                                        v-model="word_eng"
                                        aria-describedby="emailHelp"
                                    />

                                </div> -->
                                <app-input
                                    label="Переклад на українську"
                                    v-model:value="word_ukr"
                                ></app-input>
                                <!-- <div class="mb-3">
                                    <label for="word_ukr" class="form-label"
                                        >Переклад на українську</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="word_ukr"
                                        v-model="word_ukr"
                                    />
                                </div> -->
                                <div class="mb-3">
                                    <label
                                        for="example_sentences"
                                        class="form-label"
                                    >Приклади речення</label
                                    >
                                    <textarea
                                        class="form-control"
                                        id="example_sentences"
                                        v-model="example_sentences"
                                        rows="3"
                                    ></textarea>
                                </div>

                                <div class="mb-3">
                                    <label
                                        for="image"
                                        class="form-label"
                                    >Картинка</label
                                    >
                                    <input
                                        class="form-control"
                                        type="file"
                                        @change="check_image"
                                        id="image"
                                    />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Закрити
                                </button>
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Добавити слово
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Англійське слово</th>
                    <th scope="col">Преклад на українську</th>
                    <th scope="col">Приклади речень</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="all in user_all_known_word" :key="all">
                    <th scope="row">{{ all.word_eng }}</th>
                    <td>{{ all.word_ukr }}</td>
                    <td>{{ all.example_sentences }}</td>
                    <td>
                        <button class="btn btn-danger" @click="deleteWord(all.id)"> Видалити</button>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
import axios from "axios";

import AppInput from "./AppInputComponent";

export default {
    name: "AdminComponent",

    components: {
        "app-input": AppInput,
    },

    mounted() {
        this.all_known_word();
    },

    data() {
        return {
            user_all_known_word: [],
            word_eng: "",
            word_ukr: "",
            image: "",
            example_sentences: "",
            word_data: [],
        }
    },

    methods: {
        sortElement(array){
            array.sort(function (a, b) {

                return b.id - a.id//sort by id

            })
        },

        async all_known_word() {
            const secondData = await axios.get(
                "http://127.0.0.1:8000/api/dictionary/"
            );
            this.user_all_known_word = secondData.data.data;
            this.sortElement(this.user_all_known_word)
            console.log(secondData.data.data);
        },
        async deleteWord(idx) {

            await axios.delete("http://127.0.0.1:8000/api/dictionary/" + idx);

            this.user_all_known_word = this.user_all_known_word.filter((word) => word.id !== idx);
        },
        check_image(e) {
            this.image = e.target.files[0];
        },
        async addWord(e) {
            e.preventDefault();
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            let dataWord = new FormData();

            dataWord.append("word_eng", this.word_eng);
            dataWord.append("word_ukr", this.word_ukr);
            dataWord.append("example_sentences", this.example_sentences);
            dataWord.append("image", this.image);
            const response = await axios.post(
                "http://127.0.0.1:8000/api/dictionary",
                dataWord,
                config
            );
            this.user_all_known_word.push(response.data.data);
            this.sortElement(this.user_all_known_word);
            console.log(this.user_all_known_word)
            /* this.word_eng = "";
            this.word_ukr = "";*/
            this.example_sentences = "";
            this.$refs.form.reset();
        }
    }
}
</script>

<style scoped>

</style>
