<template>
    <div class="input-group mb-2">
        <input id="btn-input"
               type="text"
               name="message"
               class="form-control input-sm rounded-pill bg-light-gray"
               placeholder="Wpisz treść wiadomości..."
               v-model="newMessage"
               @keyup.enter="sendMessage">

        <span class="input-group-btn px-1">
            <button class="btn btn-primary btn-sm rounded-pill" id="btn-chat" @click="sendMessage">
                <i class="fa fa-paper-plane"></i>
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                if (this.newMessage.length == 0) {
                    return;
                }

                this.$emit('messagesent', {
                    name: this.user.name,
                    message: this.newMessage,
                    timestamp: new Date()
                });

                this.newMessage = ''
            }
        }
    }
</script>

<style lang="scss" scoped>
    #btn-chat{
        width: 38px;
        height: 38px;
        background-color: #54c4ff;
        color: #fff;
        border: 0px;
    }
</style>