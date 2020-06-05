<template>
    <div ref="main" class="h-100">
        <div v-if="shouldShow">
            <iframe :src="src"
                    :width="width"
                    :height="height"
                    frameborder="0"
                    allow="autoplay;
                fullscreen"
                    allowfullscreen></iframe>
        </div>
        <div v-else class="d-flex justify-content-center h-100">
            <div class="d-flex flex-column justify-content-center text-white">
                <Countdown :end="start"></Countdown>
            </div>
        </div>
    </div>
</template>

<script>
    import Countdown from 'vuejs-countdown';

    export default {
        name: "VVideo",

        props: ['link', 'time', 'start'],

        components: {Countdown},

        data() {
            return {
                width: 640,
                height: 480
            }
        },

        computed: {
            src() {
                return this.link + '?autoplay=1#t=10s';
                return this.link + '?autoplay=1#t=' + this.time + 's';
            },
            endDate() {
                return moment().add(this.time, 'seconds').format('YYYY-MM-DD HH:mm:ss');
            },
            shouldShow() {
                return this.time >= 0;
            }
        },

        mounted() {
            window.addEventListener('resize', this.onResize);
            this.onResize(null);
        },

        methods: {
            onResize(event) {
                if (this.shouldShow) {
                    this.width = this.$refs.main.clientWidth;
                    this.height = 0.75 * this.width;
                }
            },
        }
    }
</script>

<style scoped>

</style>