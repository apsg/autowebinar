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
                return this.link + '?autoplay=1#t=' + this.time + 's';
            },
            endDate() {
                return moment().add(this.time, 'seconds').format('YYYY-MM-DD HH:mm:ss');
            }
        },

        mounted() {
            window.addEventListener('resize', this.onResize);
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