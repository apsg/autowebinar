<template>
    <div ref="main">
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
    export default {
        name: "VVideo",

        props: ['link', 'time'],

        data() {
            return {
                width: 640,
                height: 480
            }
        },

        computed: {
            src() {
                return this.link + '?autoplay=1#t=' + this.time;
            }
        },

        mounted() {
            window.addEventListener('resize', this.onResize);
            this.onResize(null);
        },

        methods: {
            onResize(event) {
                this.width = this.$refs.main.clientWidth;
                this.height = 0.75 * this.width;
            }
        }
    }
</script>

<style scoped>

</style>