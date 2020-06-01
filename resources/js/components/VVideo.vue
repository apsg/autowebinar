<template>
    <div>
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

        created() {
            console.log(this.$el.clientWidth);
            console.log(this.$el.clientWidth);
        }
    }
</script>

<style scoped>

</style>