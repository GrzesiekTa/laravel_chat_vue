require("./bootstrap");

window.Vue = require("vue");

// Vue.component('pagination', require('laravel-vue-pagination'));
import App from "./App.vue";
import VueAxios from "vue-axios";
import axios from "axios";
import router from "./router";
import store from "./store";

require("./store/subscriber");

//default base url
axios.defaults.baseURL = "http://czat.com/";

Vue.config.productionTip = false;
Vue.use(VueAxios, axios);
Vue.component("loading", {
    template:
        '<div class="load-container start-load-container"><div class="top-50"><div class="loadersmall"></div></div></div>'
});

store.dispatch("auth/attempt", localStorage.getItem("token")).then(() => {
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
