/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
import Vue from "vue";
import VueRouter from "vue-router";
import {ServerTable, ClientTable, Event} from 'vue-tables-2';
Vue.use(VueRouter)
import App from "./components/App";
import Clients from "./components/Clients";
import ClientsCreate from "./components/ClientsCreate";
import Transactions from "./components/Transactions";
import NotFoundComponent from "./components/NotFoundComponent";
import Home from "./components/Home";
import ClientsEdit from "./components/ClientsEdit";
import BackBtn from "./components/BackBtn";
Vue.use(ServerTable, [], false, "bootstrap4", "default");
Vue.component("backBtn", BackBtn);


const router = new VueRouter({
    mode:'history',
    routes:[
        {
            path:'/admin',
            component:Home,

            children:[
                {
                    path:'clients',
                    component:Home,
                    children: [
                        {
                            path: "",
                            name: "clients",
                            component: Clients
                        },
                        {
                            path: "create",
                            name: "clients.create",
                            component: ClientsCreate
                        },
                        {
                            path: ":id",
                            name: "clients.edit",
                            component: ClientsEdit
                        }
                    ]

                },
                {
                    path:'transactions',
                    name:'transactions',
                    component:Transactions
                },
            ],

        },

        {path: "*", component: NotFoundComponent}
    ],
})


const app = new Vue({
    el: '#app',
    components:{App},
    router,

});


