/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter)
import App from "./components/App";
import Clients from "./components/Clients";
import Transactions from "./components/Transactions";
import NotFoundComponent from "./components/NotFoundComponent";
import Home from "./components/Home";

const router = new VueRouter({
    mode:'history',
    routes:[
        {
            path:'/admin',
            name:'home',
            component:Home
        },
        {
            path:'/admin/clients',
            name:'clients',
            component:Clients
        },
        {
            path:'/admin/transactions',
            name:'transactions',
            component:Transactions
        },
        {path: "*", component: NotFoundComponent}
    ],
})


const app = new Vue({
    el: '#app',
    components:{App},
    router,

});


