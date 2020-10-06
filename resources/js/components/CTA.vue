<template>
    <transition name="fade">
        <div class="cta p-3 d-flex justify-content-center align-items-center"
             v-if="is_visible">
            <div>
                <h3>{{ title }}</h3>
                <p class="font-weight-bold">{{ description }}</p>
            </div>
            <div v-if="has_button" class="pl-5">
                <a :href="button_url" target="_blank" class="btn btn-primary">
                    {{ button_text }}
                </a>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "CTA",

    data() {
        return {
            'is_visible': false
        }
    },

    props: [
        'delay',
        'duration',
        'title',
        'description',
        'button_url',
        'button_text',
    ],

    mounted() {
        if (this.delay > 0) {
            setTimeout(this.show, this.delay * 1000);
        }
    },

    methods: {
        show() {
            this.is_visible = true;
            setTimeout(this.hide, this.duration * 1000);
        },

        hide() {
            this.is_visible = false;
        }
    },

    computed: {
        has_button() {
            return !!this.button_url && !!this.button_text;
        }
    }
}
</script>

<style scoped>
.cta {
    position: absolute;
    background-color: rgba(125, 191, 202, 0.95);
    width: 100%;
    min-height: 50px;
    z-index: 1000;
    color: white;
    top: 0;
    left: 0;
    right: 0;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}

.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
{
    opacity: 0;
}
</style>