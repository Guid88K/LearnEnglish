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
                    <button type="button" class="btn btn-primary">
                        Добавити слова
                    </button>
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
            item_in_arr: 0,
            word_data: [],
        };
    },
    methods: {
        null_data() {
            this.word_data = [];
        },
        async get_data() {
            const { data } = await axios.get(
                "http://127.0.0.1:8000/api/dictionary"
            );
            this.word_data = data.data;
            console.log(this.word_data);
        },
    },
};
</script>

<style></style>
