/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import Echo from "laravel-echo";
import Pusher from "pusher-js";

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import IndexClinicalHistory from './components/clinicalHistories/Index.vue';
import EditClinicalHistory from './components/clinicalHistories/Edit.vue';
import CreateClinicalHistory from './components/clinicalHistories/Create.vue';
app.component('example-component', ExampleComponent);
app.component('index-clinical-history', IndexClinicalHistory);
app.component('edit-clinical-history', EditClinicalHistory);
app.component('create-clinical-history', CreateClinicalHistory);

  const router = createRouter({
    history: createWebHistory(),
    routes: [
      // Define your routes here
      { path: '/clinicalhistories/:id/edit', component: EditClinicalHistory },
      // Add other routes as needed
    ],
  });

  window.Pusher = Pusher; // Assign Pusher to window.Pusher

  window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'e8cafa719a14859b4ea8', 
    cluster: 'us2', 
    encrypted: true,
  });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

// Use Vue Router with the app
app.use(router);

// Mount the app to the HTML element
app.mount('#app');
