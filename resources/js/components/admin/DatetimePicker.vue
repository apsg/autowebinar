<template>
    <div class="form-control">
        <input type="hidden" v-model="selectedDate" :name="name">
        <datetime v-model="selectedDate"
                  type="datetime"
                  zone="Europe/Warsaw"
                  value-zone="Europe/Warsaw"
        ></datetime>
    </div>
</template>

<script>
import {Datetime} from 'vue-datetime';

export default {
    name: "DatetimePicker",

    props: ['name', 'date'],

    data() {
        return {
            selectedDate: null
        };
    },

    components: {
        datetime: Datetime
    },

    mounted() {
        this.selectedDate = this.date;
    }
}
</script>

<style scoped>

</style>