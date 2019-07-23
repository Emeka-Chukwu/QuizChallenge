/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// import Vue from 'vue';
import VueRouter from 'vue-router'
import VueResource from 'vue-resource';
import axios from 'axios';


Vue.use(VueRouter);
Vue.use(VueResource);
// Vue.use(axios);

const routes = [
    { path: '/emeka', name: 'emeka', component: require('./components/quiz.vue').default },
    { path: '/', component: require('./components/startquiz.vue').default },
    { path: '/user', name: 'navbar', component: require('./components/navbar.vue').default },
    { path: '/challenges', name: 'challenges', component: require('./components/challenges/index.vue').default },
    { path: '/challenges/creat', name: 'challengesCreate', component: require('./components/challenges/create.vue').default },
    { path: '/challenges/:id/edit', name: 'challengesEdit', component: require('./components/challenges/edit.vue').default },
    { path: '/challenges/:id/delete', name: 'challengesDelete', component: require('./components/challenges/delete.vue').default },
    { path: '/questions', name: 'questions', component: require('./components/questions/index.vue').default },
    { path: '/questions/create', name: 'questionsCreate', component: require('./components/questions/create.vue').default },
    { path: '/questions/:id/edit', name: 'questionsEdit', component: require('./components/questions/edit.vue').default },
    { path: '/questions/:id/delete', name: 'questionsDelete', component: require('./components/questions/delete.vue').default },
    { path: '/subjects', name: 'subjects', component: require('./components/subjects/create.vue').default },
    { path: '/topics', name: 'topics', component: require('./components/topics/create.vue').default },

]

const router = new VueRouter({
    // history: true,
    routes: routes,
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar-component', require('./components/navbar.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});