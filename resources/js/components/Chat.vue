<template>
    <div class="row chat-container">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Rozmowa</div>
                <div class="panel-body" ref="chat-panel" id="scroll">
                    <chat-messages :messages="messages" ref="chat-messages"></chat-messages>
                </div>
                <div class="panel-footer pt-2">
                    <chat-form
                            v-on:messagesent="addMessage"
                            :user="user"
                    ></chat-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "Chat",

        props: ['user', 'webinar'],

        data() {
            return {
                messages: []
            }
        },

        created() {
            this.fetchMessages();

            Echo.private('chat.' + this.webinar)
                .listen('.chat.message', (e) => {
                    console.log(e);
                    this.messages.push({
                        message: e.message.message,
                        user: e.user,
                        created_at: e.message.created_at
                    });
                });
        },

        mounted() {
            window.addEventListener('resize', this.onResize);
            this.scrollBottom();
        },

        methods: {
            fetchMessages() {
                axios.get('/webinar/' + this.webinar + '/messages').then(response => {
                    this.messages = response.data;
                });
            },

            addMessage(message) {
                this.messages.push(message);

                axios.post('/webinar/' + this.webinar + '/messages', message).then(response => {
                    console.log(response.data);
                });

                this.scrollBottom();
            },

            onResize(event) {

            },

            scrollBottom() {
                var el = document.getElementById('scroll');
                el.scrollTop = el.scrollHeight;
            }
        }
    }
</script>

<style scoped>

    .chat-container {
        background-color: rgba(255, 255, 255, 0.5);
    }

    .panel-body {
        overflow-y: scroll;
        height: 480px;
    }
</style>