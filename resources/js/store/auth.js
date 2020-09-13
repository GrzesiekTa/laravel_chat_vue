import axios from "axios";

export default {
    namespaced: true,
    state: {
        token: null,
        user: null
    },
    getters: {
        authenticated(state) {
            return state.token && state.user;
        },
        user(state) {
            return state.user;
        }
    },
    mutations: {
        SET_TOKEN(state, token) {
            // console.log(token);
            state.token = token;
        },
        SET_USER(state, data) {
            // console.log(data);
            state.user = data;
            //TODO ???
            if(state.user) {
                state.user.avatatPath = '';
            }

            if(state.user && (state.user.images.length != 0)) {
                state.user.avatatPath = "/storage/users/" + state.user.id + "/avatars/" + state.user.images.avatar.small;
            }
        }
    },
    actions: {
        async signIn({ dispatch }, credentials) {
            const response = await axios.post("/api/auth/login", credentials)

            return dispatch("attempt", response.data.access_token);

            // .then(response => {
            //     return dispatch("attempt", response.data.access_token);
            // })
            // .catch(error => {
            //     throw new Error(error);
            // });
        },
        async attempt({ commit, state }, token) {
            if (token) {
                commit("SET_TOKEN", token);
            }

            if (!state.token) {
                return;
            }

            const response = await axios
                .get("/api/auth/me")
                //important !!! added headers in subscriber.js!!!

                // .get("/api/auth/me", {
                //     headers: {
                //         Authorization: "Bearer " + token
                //     }
                // })
                .then(response => {
                    commit("SET_USER", response.data);
                })
                .catch(error => {
                    commit("SET_TOKEN", null);
                    commit("SET_USER", null);
                });
        },
        signOut({ commit }) {
            return axios.post("api/auth/logout").then(() => {
                commit("SET_TOKEN", null);
                commit("SET_USER", null);
            });
        }
    }
};
