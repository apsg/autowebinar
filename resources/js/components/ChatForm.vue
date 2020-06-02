<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm h-100" id="btn-chat" @click="sendMessage">
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
                    user: this.user,
                    message: this.newMessage,
                    created_at: new Date()
                });

                this.newMessage = ''
            }
        }
    }
</script>