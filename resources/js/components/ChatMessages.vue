<template>
    <ul class="chat">
        <li class="clearfix px-3" :class="classForMessage(message)" v-for="message in messages">
            <div class="name small" >
                {{ (message.name == user.name) ? "Ty" : message.name  }}
            </div>
            <div class="chat-body clearfix px-2 py-1">
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['messages', 'user'],

        methods:{
            classForMessage(message){
                let classes = [];

                if(message.is_admin) {
                    classes.push('admin');
                }

                if(message.name == this.user.name){
                    classes.push('you');
                }

                return classes.join(' ');
            }
        }
    };
</script>

<style lang="scss">

    .chat {
        list-style: none;
        margin: 0;
        padding: 0;
        font-family: 'DINPro-Bold';
        text-align: right;

        li{
            padding-bottom: 5px;
        }

        .chat-body{
            max-width: 80%;
            background-color: #e1e5ee;
            color: #606060;
            text-align: left;
            display: inline-block;
            overflow: hidden;
        }

        .name{
            color: #6f6f6f;
            font-weight: 400;
        }
    }

    .you{
        .chat-body{
            border-bottom: 2px solid #54c4ff;
        }
    }

    .admin{
        text-align: left;

        .name{
            color: #54c4ff;
            text-align: left;
        }

        .chat-body{
            background-color: #54c4ff;
            color: white;
        }
    }

    .small {
        font-size: 0.8em;
    }

    .chat li .chat-body p {
        margin: 0;
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar {
        width: 12px;
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #555;
    }
</style>