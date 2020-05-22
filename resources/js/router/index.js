import Vue from "vue";
import VueRouter from "vue-router";
import HomeComponent from "../components/HomeComponent.vue";
import LoginComponent from "../components/Auth/LoginComponent.vue";
import DashboardComponent from "../components/DashboardComponent.vue";

import EditUserComponent from "../components/User/EditUserComponent.vue";

import store from "../store";

Vue.use(VueRouter);

const routes = [
    {
        name: "home",
        path: "/",
        component: HomeComponent
    },
    {
        name: "login",
        path: "/login",
        component: LoginComponent
    },
    {
        name: "userEdit",
        path: "/user/edit",
        component: EditUserComponent
    },
    {
        name: "dashboard",
        path: "/dashboard",
        component: DashboardComponent,
        beforeEnter: (to, from, next) => {
            // console.log(store.getters);
            if (!store.getters["auth/authenticated"]) {
                return next({ name: "login" });
            }
            // console.log('middleware');
            next();
        }
    },
    {
        name: "login",
        path: "/login",
        component: LoginComponent
    },
    {
        name: "404",
        path: "/404",
        component: {
            template: "<p>Page Not Found</p>"
        }
    }
];

const router = new VueRouter({
    mode: "history",
    routes: routes
});

export default router;
