/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import App from './components/App.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import ProductList from './components/ProductList.vue';
import ProductForm from './components/ProductForm.vue';
import Product from './components/Product.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: ProductList},
        { path: '/login', component: Login },
        { path: '/register', component: Register },
        { path: '/products/create', component: ProductForm },
        { path: '/products/:id', component: Product },
        { path: '/products/:id/edit', component: ProductForm },
    ]
});
const app = createApp(App);
app.use(router);
app.mount('#app');