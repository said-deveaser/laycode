import Vue from 'vue';
import VueRouter from 'vue-router';
import Main from '../vue/index.vue';
import Registry from '../vue/registry.vue';
import Cabinet from '../vue/cabinet.vue';
console.log('TESTED');
console.log(Cabinet);


Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {path: '/', component: Main},
        {path: '/registry', component: Registry},
        {path: '/cabinet', component: Cabinet}
    ]
})


