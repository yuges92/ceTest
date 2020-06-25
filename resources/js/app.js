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
import Clients from "./components/clients/Clients";
import ClientsCreate from "./components/clients/ClientsCreate";
import Transactions from "./components/transactions/Transactions";
import TransactionCreate from "./components/transactions/TransactionCreate";
import TransactionEdit from "./components/transactions/TransactionEdit";
import NotFoundComponent from "./components/NotFoundComponent";
import Home from "./components/Home";
import ClientsEdit from "./components/clients/ClientsEdit";
import BackBtn from "./components/BackBtn";
import VueSweetalert2 from 'vue-sweetalert2';
import Multiselect from 'vue-multiselect'

import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);
Vue.use(ServerTable, [], false, "bootstrap4", "default");
Vue.component("backBtn", BackBtn);
Vue.component('multiselect', Multiselect)

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
                        },
                        {
                            path: ":id/transactions",
                            name: "clients.addTransaction",
                            component: TransactionCreate
                        },
                    ]

                },
                {
                    path:'transactions',
                    component:Home,
                    children: [
                        {
                            path: "",
                            name: "transactions",
                            component: Transactions
                        },

                        {
                            path: ":id",
                            name: "transactions.edit",
                            component: TransactionEdit
                        }
                    ]
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


