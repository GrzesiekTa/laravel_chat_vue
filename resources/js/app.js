require("./bootstrap");

window.Vue = require("vue");




// Vue.component('pagination', require('laravel-vue-pagination'));
import App from "./App.vue";
import VueAxios from "vue-axios";
import axios from "axios";
import router from "./router";
import store from "./store";

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

require("./store/subscriber");

//default base url
axios.defaults.baseURL = "http://czat.com/";

Vue.config.productionTip = false;
Vue.use(VueAxios, axios);

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)


Vue.component("loading", {
    template:
        '<div class="load-container start-load-container"><div class="top-50"><div class="loadersmall"></div></div></div>'
});

store.dispatch("auth/attempt", localStorage.getItem("token")).then(() => {

    const token = localStorage.getItem("token");

    window.Echo = new Echo({
        //authEndpoint: 'http://czat.com/api/broadcasting/auth',
        authEndpoint:'/api/broadcasting/auth',
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        //cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        forceTLS: false,
        wsHost: window.location.hostname,
        wsPort: 6001,
        wssPort: 6001,
        disableStats: true,
        auth: {
            headers: {
                'Authorization': `Bearer ${token}`,
            },
        }
    });

    const app = new Vue({
        router,
        store,
        el: "#app",
        components: { App },
        data: { loading: false }
    });
    
    router.beforeEach((to, from, next) => {
        app.loading = true;
        next();
    });

    router.afterEach((to, from, next) => {
        setTimeout(() => (app.loading = false), 250);
    });
});
