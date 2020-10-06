require('./bootstrap');
window.Vue = require('vue');
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
Vue.component('v-video', require('./components/VVideo.vue').default);
Vue.component('chat', require('./components/Chat.vue').default);
Vue.component('countdown', require('vuejs-countdown').default);
Vue.component('timer', require('./components/Timer.vue').default);
Vue.component('cta', require('./components/CTA.vue').default);
Vue.component('datetime-picker', require('./components/admin/DatetimePicker.vue').default);

Vue.use(require('vue-moment'));

const app = new Vue({
    el: '#app'
});
