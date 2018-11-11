
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.$http = window.axios

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
Vue.use(ElementUI)

import lang from 'element-ui/lib/locale/lang/es'
import locale from 'element-ui/lib/locale'
locale.use(lang)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

let users = Vue.component('users', require('./components/UserComponent.vue'));
let listUsers = Vue.component('list-user', require('./components/UsersComponent.vue'));
let usersProfile = Vue.component('profile-user', require('./components/UserProfile.vue'));

const app = new Vue({
    el: '#app',
    components:{
        'users': users,
        'list-user': listUsers,
        'profile-user': usersProfile
    }
});
