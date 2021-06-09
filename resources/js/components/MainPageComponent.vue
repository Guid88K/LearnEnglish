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
                    <div v-if="active_status === 1">
                        <div class="card" style="width: 40rem">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <button
                                        type="button"
                                        class="btn-close"
                                        aria-label="Close"
                                        @click="this.active_status = 0"
                                    ></button>
                                </div>
                                <img
                                    class="card-img-top rounded mx-auto d-block"
                                    style="max-width: 250px; height: auto"
                                    :src="
                                        '/uploads/' +
                                        word_data[item_in_arr].image
                                    "
                                    alt="Card image cap"
                                />
                                <p
                                    class="
                                        card-text
                                        h4
                                        text-center
                                        font-weight-bold
                                    "
                                >
                                    {{ word_data[item_in_arr].word_eng }}
                                </p>

                                <p class="card-text">Переклад:</p>
                                <p class="card-text h5 text-center">
                                    {{ word_data[item_in_arr].word_ukr }}
                                </p>
                                <p class="card-text">Приклади речення:</p>
                                <p class="card-text">
                                    {{ word_data[item_in_arr].example_sentences }}
                                </p>

                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <button
                                            @click="
                                                save_word(
                                                    word_data[item_in_arr].id
                                                )
                                            "
                                            class="btn btn-primary"
                                        >
                                            Знаю
                                        </button>
                                        <button
                                            @click="not_know_word"
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

                    <div v-else-if="active_status === 0">
                        Натисніть "Вчити слова", щоб розпочати
                    </div>

                    <div v-if="all_word === 1">
                        <div class="card" style="width: 40rem">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <button
                                        type="button"
                                        class="btn-close"
                                        aria-label="Close"
                                        @click="close_all_known_word"
                                    ></button>
                                </div>

                                <p
                                    class="
                                        card-text
                                        h4
                                        text-center
                                        font-weight-bold
                                    "
                                >
                                    Всі вивчені слова
                                </p>

                                <div class="row p-2" v-for="word_u in user_all_known_word" :key="word_u">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 text-center">
                                        <strong>{{ word_u.word_eng }} - {{ word_u.word_ukr }}</strong>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <p class="card-text text-center">{{ word_u.example_sentences }}</p>
                                </div>

                                <div class="card-body">
                                    <div class="d-flex justify-content-end">
                                        <button
                                            @click="close_all_known_word"
                                            class="btn btn-primary"
                                        >
                                            Закрити
                                        </button>
                                    </div>
                                    <div
                                        class="pt-2 d-flex justify-content-end"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        @click="all_known_word"
                        class="btn btn-primary"
                    >
                        Вивчені слова
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import AppInput from "./AppInputComponent.vue";

export default {
    components: {
        "app-input": AppInput,
    },
    data() {
        return {
            word_eng: "",
            word_ukr: "",
            image: "",
            example_sentences: "",
            active_status: 0,
            all_word: 0,
            item_in_arr: 0,
            word_data: [],
            user_all_known_word: [],
            user_id: document
                .querySelector("meta[name='user-id']")
                .getAttribute("content"),

        };
    },

    methods: {
        async all_known_word() {
            const secondData = await axios.get(
                "http://127.0.0.1:8000/api/all_user_word/" + this.user_id
            );
            this.user_all_known_word = secondData.data.data;
            this.all_word = 1;
            this.active_status = 2;

            console.log(secondData.data.data);
        },
        close_all_known_word() {
            this.all_word = 0;
            this.active_status = 0;
        },
        null_data() {
            this.word_data = [];
        },

        not_know_word() {
            shuffle(this.word_data);
            console.log(this.word_data);
        },
        async get_data() {
            const {data} = await axios.get(
                "http://127.0.0.1:8000/api/dictionary"
            );
            const secondData = await axios.get(
                "http://127.0.0.1:8000/api/all_user_word/" + this.user_id
            );
            this.all_word = 0;
            this.active_status = 1;

            this.word_data = data.data.filter(
                (ar) => !secondData.data.data.find((rm) => rm.id === ar.id)
            );
            console.log(this.word_data);

            shuffle(this.word_data);
        },


        async save_word(word_id) {
            const data = await axios.post(
                "http://127.0.0.1:8000/api/save_word/" +
                this.user_id +
                "/" +
                word_id
            );
            console.log(data);
            this.item_in_arr++;
        },
    },
};

function shuffle(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}
</script>

<style></style>
