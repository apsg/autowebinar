<template>
    <div class="row chat-container">
        <div class="col-md-12 ">
<!--            <span>Time: {{ time }}</span>-->
            <div class="panel panel-default">
                <div class="panel-body" ref="chatpanel" id="scroll">
                    <chat-messages :messages="messages" :user="user" ref="chat-messages"></chat-messages>
                </div>
                <div class="panel-footer pt-2">
                    <chat-form
                            v-on:messagesent="addMessage"
                            :user="user"
                    ></chat-form>
                </div>
            </div>
        </div>
        <div class="overflow">&nbsp;</div>
    </div>
</template>

<script>

    export default {
        name: "Chat",

        props: ['user', 'webinar'],

        data() {
            return {
                messages: [],
                scheduled: [],
                time: 0
            }
        },

        created() {
            this.fetchMessages();

            Echo.private('chat.' + this.webinar)
                .listen('.chat.message', (e) => {
                    this.messages.push({
                        message: e.message.message,
                        name: e.user.name,
                        created_at: e.message.created_at
                    });
                });

            setTimeout(this.tick, 1000);
        },

        mounted() {
            window.addEventListener('resize', this.onResize);
            this.scrollBottom();
        },

        methods: {
            fetchMessages() {
                axios.get('/webinar/' + this.webinar + '/messages').then(response => {
                    this.messages = response.data.messages;
                    this.scheduled = response.data.scheduled;
                    this.time = response.data.time;

                    this.processScheduled();
                });
            },

            addMessage(message) {
                this.messages.push(message);
                this.scrollBottom();

                axios.post('/webinar/' + this.webinar + '/messages', message).then(response => {
                    console.log(response.data);
                });
            },

            onResize(event) {

            },

            scrollBottom() {
                this.$refs.chatpanel.scrollTop = this.$refs.chatpanel.scrollHeight;
            },

            tick() {
                this.time += 1;
                this.processScheduled();
                setTimeout(this.tick, 1000);
            },

            processScheduled() {
                this.scheduled
                    .filter(message => message.time <= this.time)
                    .forEach(message => {
                        console.log('Adding message ' + message);
                        this.messages.push(message);
                        this.scheduled.splice(this.scheduled.indexOf(message), 1);
                    });

                this.scrollBottom();
            }
        }
    }
</script>

<style lang="scss" scoped>

    .chat-container {
        background-color: rgba(255, 255, 255, 0.5);
        position: relative;

        .overflow{
            position: absolute;
            top:0;
            left: 0;
            right: 0;
            height: 50px;
            background: linear-gradient(to bottom, white, transparent);
            z-index: 1000;
        }
    }

    .panel-body {
        overflow-y: scroll;
        height: 400px;
        overflow-x: hidden;
    }


</style>
