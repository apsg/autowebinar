<template>
    <div ref="main" class="h-100">
        <iframe :src="src"
                :width="width"
                :height="height"
                frameborder="0"
                allow="autoplay;
                fullscreen"
                allowfullscreen></iframe>
    </div>
</template>

<script>
    import Countdown from 'vuejs-countdown';

    export default {
        name: "VVideo",

        props: ['link', 'time'],

        components: {Countdown},

        data() {
            return {
                width: 640,
                height: 480
            }
        },

        computed: {
            src() {
                return this.link + '?autoplay=1#t=' + this.time + 's';
            },
            endDate() {czy dev wolny?
                return moment().add(this.time, 'seconds').format('YYYY-MM-DD HH:mm:ss');
            }
        },

        mounted() {
            window.addEventListener('resize', this.onResize);
            // setTimeout(this.onResize, 1000);
            window.onload = this.onResize;
        },

        methods: {
            onResize(event) {
                this.width = this.$refs.main.clientWidth;
                this.height = Math.floor((9/16) * this.width);
            },
        }
    }
</script>

<style scoped>

</style>