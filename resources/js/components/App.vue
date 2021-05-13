<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="d-flex justify-content-center">
                    <div
                        v-if="
                            word_data.length === item_in_arr &&
                            item_in_arr !== 0
                        "
                    >
                        <div class="card" style="width: 40rem">
                            <!-- <img
                                class="card-img-top"
                                :src="'/uploads/' + w_data.image"
                                alt="Card image cap"
                            /> -->
                            <div class="card-body">
                                <p class="card-text">Слів більше немає</p>

                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <button
                                            @click="null_data"
                                            class="btn btn-primary"
                                        >
                                            Закрити
                                        </button>
                                        <button
                                            @click="item_in_arr = 0"
                                            class="btn btn-primary"
                                        >
                                            Почати спочатку
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="word_data.length !== 0">
                        <div class="card" style="width: 40rem">
                            <!-- <img
                                class="card-img-top"
                                :src="'/uploads/' + w_data.image"
                                alt="Card image cap"
                            /> -->

                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <button
                                        type="button"
                                        class="btn-close"
                                        aria-label="Close"
                                        @click="close"
                                    ></button>
                                </div>
                                <p
                                    class="card-text h4 text-center font-weight-bold"
                                >
                                    {{ word_data[item_in_arr].word_eng }}
                                </p>

                                <p class="card-text">Переклад:</p>
                                <p class="card-text h5 text-center">
                                    {{ word_data[item_in_arr].word_ukr }}
                                </p>
                                <p class="card-text">Приклади речення:</p>
                                <p class="card-text">
                                    {{
                                        word_data[item_in_arr].example_sentences
                                    }}
                                </p>

                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <button
                                            @click="item_in_arr++"
                                            class="btn btn-primary"
                                        >
                                            Знаю
                                        </button>
                                        <button
                                            @click="item_in_arr++"
                                            class="btn btn-primary"
                                        >
                                            Не знаю
                                        </button>
                                    </div>
                                    <div
                                        class="pt-2 d-flex justify-content-end"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else>Натисніть "Вчити слова", щоб розпочати</div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="m-1">
                    <button @click="get_data" class="btn btn-primary">
                        Вчити слова
                    </button>
                </div>
                <div class="m-1">
                    <button
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#addWord"
                        class="btn btn-primary"
                    >
                        Добавити слова
                    </button>
                </div>

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
                                @submit.prevent="addWord"
                                enctype="multipart/form-data"
                            >
                                <div class="modal-body">
                                    <div class="mb-3">
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
                                        <!-- <div id="emailHelp" class="form-text">
                                            We'll never share your email with
                                            anyone else.
                                        </div> -->
                                    </div>
                                    <div class="mb-3">
                                        <label for="word_ukr" class="form-label"
                                            >Переклад на українську</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="word_ukr"
                                            v-model="word_ukr"
                                        />
                                    </div>
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
                                            for="formFileMultiple"
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

                <div class="m-1">
                    <button type="button" class="btn btn-primary">
                        Отримати статистику
                    </button>
                </div>
                <div class="m-1">
                    <button type="button" class="btn btn-primary">
                        Вивчені слова
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            word_eng: "",
            word_ukr: "",
            image: "",
            example_sentences: "",
            item_in_arr: 0,
            word_data: [],
        };
    },
    methods: {
        null_data() {
            this.word_data = [];
        },
        check_image(e) {
            this.image = e.target.files[0];
            console.log(this.image);
        },
        async get_data() {
            const { data } = await axios.get(
                "http://127.0.0.1:8000/api/dictionary"
            );
            this.word_data = data.data;
            console.log(this.word_data);
        },
        close() {
            this.word_data = [];
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
            console.log(response);
            this.word_data.push(dataWord);
            this.word_eng = "";
            (this.word_ukr = ""), (this.example_sentences = "");
            (this.image = []), console.log(this.image);
        },
    },
};
</script>

<style></style>
