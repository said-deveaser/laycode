import './scss/styles.scss';
import './scss/media.scss';
import './vueplugins/index'
import Vue from 'vue';
import App from './vue/app.vue';
import router from  './vueplugins/vue-router'

new Vue({
    router,
    template: '<App/>',
    components: {
        App
      },
}).$mount('#app');