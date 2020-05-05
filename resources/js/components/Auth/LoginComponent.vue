<template>
  <div class="cotainer">
    <br />
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-primary text-white">Login Panel</div>
          <div class="card-body">
            <div class="error-message">{{form.error}}</div>
            <form action @submit.prevent="submit">
              <!-- {{form}} -->
              <div>
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" v-model="form.email" required>
              </div>
              <div>
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="form.password" required>
              </div>
              <br />
              <div>
                <button type="submit" class="btn btn-primary btn-sm btn-block">Zaloguj się</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <br />
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
        error: null
      }
    };
  },
  created() {
    // console.log("login console log");
    // console.log(mapActions);
  },
  methods: {
    ...mapActions({
      signIn: "auth/signIn"
    }),
    submit() {
      this.signIn(this.form)
        .then(response => {
          this.$router.replace({
            name: "dashboard"
          });
        })
        .catch(error => {
          if (error.response.status === 401) {
            let errorMessage = error.response.data.error;
            this.form.error = errorMessage;
            return;
          }

          this.form.error = "Server error";
        });
    }
  }
};
</script>
<style>
.error-message:not(:empty) {
  color: #fff;
  background: 9px 9px no-repeat #cc3b3b;
  padding: 5px 15px 3px 25px;
  border-radius: 2px;
  margin: 12px 0 0;
  text-align: center;
}
</style>