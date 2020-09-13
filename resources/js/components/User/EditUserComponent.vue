<template>
  <div class="container">
    <!-- {{user}} -->
    <div class="message alert alert-success spacing" v-show="message">{{ message }}</div>
    <div class="alert alert-danger spacing" role="alert" v-show="errorMessage">{{errorMessage}}</div>
    <form @submit="updatePerson" enctype="multipart/form-data">
      <div class="text-center">
        <img
          style="margin: 0 auto;width: 80px; height:80px"
          :src="avatar"
          alt="Avatar"
          class="img-responsive rounded-circle"
        />
      </div>
      <div class>
        <label>
          Zdjęcie
          <input
            type="file"
            name="avatar"
            id="avatar"
            ref="file"
            v-on:change="handleFileUpload()"
          />
        </label>
        <div class="input-error" v-if="fieldsErrors.avatar">{{fieldsErrors.avatar}}</div>
      </div>

      <div class>
        <input v-model="user.name" class="form-control" required />
        <div class="input-error" v-if="fieldsErrors.name">{{fieldsErrors.name}}</div>
      </div>

      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {
      avatarFile: "",
      avatar: null,
      message: null,
      errorMessage: null,
      fieldsErrors: []
    };
  },
  created() {
    this.avatar = this.user.avatatPath; 
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    })
  },
  methods: {
    updatePerson(e) {
      e.preventDefault();
      parent = this;
      this.message = null;

      const config = {
        headers: { "content-type": "multipart/form-data" }
      };

      const formData = new FormData();
      console.log(this.avatarFile);
      formData.append("name", this.user.name);
      formData.append("avatar", this.avatarFile);
      formData.append("_method", "PUT");

      const uri = `/api/auth/user/2`;

      this.axios
        .post(uri, formData, config)
        .then(response => {
          parent.message = response.data.message;
          console.log(response);
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.fieldsErrors = [];
            const errors = error.response.data.errors;
            for (var key in errors) {
              this.fieldsErrors[key] = errors[key][0];
            }
            return;
          }
          if (error.response.data.message != "undefined") {
            this.errorMessage = error.response.data.message;
          }
        });

      //console.log(this.user.name);
    },
    handleFileUpload() {
      this.avatarFile = this.$refs.file.files[0];
      this.showFile(this.avatarFile);
    },
    showFile(file) {
      parent = this;
      if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
          parent.avatar = e.target.result;
        };

        reader.readAsDataURL(file);
      }
    }
  }
};
</script>
<style>
.input-error {
  color: #fff;
  background: 9px 9px no-repeat #cc3b3b;
  padding: 5px 15px 3px 25px;
  font-size: 13px;
  border-radius: 2px;
  margin: 12px 0 0;
  text-align: center;
}
</style>