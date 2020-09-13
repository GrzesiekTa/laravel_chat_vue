<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <router-link :to="{ name: 'home' }" class="navbar-brand">Czat</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <template v-if="authenticated">
              <li class="nav-item">
                <a href>
                  <img
                    :src="user.avatatPath"
                    style="margin: 0 auto;width: 40px; height:40px"
                    class="rounded-circle"
                    alt
                  />
                </a>
              </li>
              <li class="nav-item dropdown">
                <a
                  id="navbarDropdown"
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                  @click="loadConversations"
                >
                  <i class="fab fa-facebook-messenger"></i>
                  <span
                    class="counter counter-lg"
                    v-if="unreadMessages"
                  >{{ numberOfUnreadMessages }}</span>

                  <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <li v-for="singleData in conversations">
                    <div class="row" @click="loadConversation(singleData.conversation_id)">
                      <div class="col-2">
                        <img
                          style="margin: 0 auto;width: 40px; height:40px"
                          :src="'/storage/users/' + singleData.sender.id + '/avatars/' + singleData.sender.images.avatar.small"
                          alt="Avatar"
                          class="img-responsive rounded-circle"
                          :title="singleData.sender.name"
                        />
                      </div>
                      <div class="col-10">
                        <p style="margin: 0">
                          <b>{{ singleData.sender.name }}</b>
                        </p>
                        <p style="margin: 0">{{ singleData.data.message }}</p>
                      </div>
                    </div>
                    <hr />
                  </li>
                </div>
              </li>

              <li class="nav-item">
                <router-link :to="{ name: 'dashboard' }" class="nav-link">Dashboard</router-link>
              </li>
              <li class="nav-item dropdown">
                <a
                  id="navbarDropdown"
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  {{user.name}}
                  <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <router-link :to="{ name: 'userEdit' }" class="dropdown-item">Edycja</router-link>
                  <router-link :to="{ name: 'message' }" class="dropdown-item">Chat</router-link>
                </div>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link" @click.prevent="signOut">Wyloguj się</a>
              </li>
            </template>
            <template v-else>
              <li class="nav-item">
                <router-link :to="{ name: 'login' }" class="nav-link">Zaloguj się</router-link>
              </li>
            </template>
          </ul>
        </div>
      </div>
    </nav>
    <div class="col-12 text-center" v-if="authenticated">
      <h1>hi {{user.name}}</h1>
      <p>Your email{{user.email}}</p>
      <p>aaa aaa</p>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import unreadConversations from "../store/unreadConversations.js";
import axios from "axios";

export default {
  data() {
    return {
      unreadMessages: false,
      numberOfUnreadMessages: false,
      conversations: null
    };
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user"
    })
  },
  created() {
    this.loadCountUnreadMessages();
  },
  methods: {
    ...mapActions({
      signOutAction: "auth/signOut"
    }),
    loadConversations(event) {
      if (!this.conversations) {
        axios.get("/api/auth/conversations").then(response => {
          this.conversations = response.data;
        });
      }
    },
    loadConversation(id) {
      console.log(id);
    },
    loadCountUnreadMessages() {
      axios.get("/api/auth/countUnreadMessages").then(response => {
        this.numberOfUnreadMessages = response.data;
        if (this.numberOfUnreadMessages > 0) {
          this.unreadMessages = true;
        }
      });
    },
    signOut() {
      this.signOutAction().then(() => {
        this.$router.replace({
          name: "home"
        });
      });
    }
  }
};
</script>
<style>
.counter.counter-lg {
  top: -20px !important;
}
.counter {
  position: relative;
  top: -23px;
  left: auto;
  z-index: 2;
  padding: 1px 7px;
  margin-left: -23px;
  font-size: 11px;
  background-color: #fe1212;
  border-radius: 10em;
  -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16),
    0 2px 10px 0 rgba(0, 0, 0, 0.12);
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}

.fa-facebook-messenger {
  color: #1976d2 !important;
  font-size: 30px;
}
</style>