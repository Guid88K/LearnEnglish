<template>
    <div>
        <div class="div">

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

export default {
    name: "AdminComponent",
    mounted() {
        this.all_known_word();
    },
    data() {
        return {
            user_all_known_word: [],
        }
    },

    methods: {
        async all_known_word() {
            const secondData = await axios.get(
                "http://127.0.0.1:8000/api/dictionary/"
            );
            this.user_all_known_word = secondData.data.data;
            console.log(secondData.data.data);
        },
        async deleteWord(idx) {

            await axios.delete("http://127.0.0.1:8000/api/dictionary/" + idx);

            this.user_all_known_word = this.user_all_known_word.filter((word) => word.id !== idx);
        }
    }
}
</script>

<style scoped>

</style>
