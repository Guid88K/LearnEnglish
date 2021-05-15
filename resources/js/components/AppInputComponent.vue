<template>
    <div class="mb-3">
        <label :for="id" class="form-label">{{ label }}</label>
        <input
            type="text"
            class="form-control"
            :id="id" :value="value" @input="change"
        />
    </div>
</template>

<script>
export default {
    emits: ["update:value"],
    props: {
        label: String,
        value: String,
    },
    data() {
        return {
            id: "input-" + Math.random(),
        };
    },
    methods: {
        change(event) {
           
            this.$emit("update:value", event.target.value);
        },
    },
};
</script>

<style></style>
