/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import { Form } from 'vform'
window.Form = Form;

//import App from './components/App.vue';
import { createApp } from 'vue';
const app = createApp({})

import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
    } from 'vform/src/components/bootstrap5'

app.component(Button.name, Button)
app.component(HasError.name, HasError)
app.component(AlertError.name, AlertError)
app.component(AlertErrors.name, AlertErrors)
app.component(AlertSuccess.name, AlertSuccess)

/*import VueAxios from 'vue-axios';
import axios from 'axios';
app.use(VueAxios, axios);*/

/*import router from './router';
app.use(router);*/

app.component('profile-component', require('./components/pages/ProfileComponent.vue').default);
app.component('tomo-component', require('./components/pages/TomoComponent.vue').default);
app.component('calendar-component', require('./components/CalendarComponent.vue').default);
app.component('carousel-component', require('./components/CarouselComponent.vue').default);
app.component('searchbar-component', require('./components/SearchbarComponent.vue').default);

app.mount('#app');
