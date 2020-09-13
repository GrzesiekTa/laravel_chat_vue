import axios from "axios";

export default {
    namespaced: true,
    state: {
        bobek: null
    },
    mutations: {},
    actions: {
        dawaj() {
            return axios.get("/api/auth/conversations").then(response => {
                return response;
            });
        }
    }
};
