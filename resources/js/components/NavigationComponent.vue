<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href>Czat</a>
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
            <li class="nav-item">
              <router-link :to="{ name: 'home' }" class="nav-link">Strona główna</router-link>
            </li>

            <template v-if="authenticated">
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
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user"
    })
  },
  methods: {
    ...mapActions({
      signOutAction: "auth/signOut"
    }),

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