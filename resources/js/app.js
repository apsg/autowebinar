require('./bootstrap');
window.Vue = require('vue');
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
Vue.component('v-video', require('./components/VVideo.vue').default);
Vue.component('chat', require('./components/Chat.vue').default);

Vue.use(require('vue-moment'));

const app = new Vue({
    el: '#app'
});
