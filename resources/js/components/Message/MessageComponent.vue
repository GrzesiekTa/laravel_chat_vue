<template>
  <div class="row">
    <div class="col-8">
      <div class="card card-default">
        <div class="card-body p-0">
          <ul class="list-unstyled" style="height:300px; overflow-y:scroll" v-chat-scroll>
            <li class="p-2" v-for="(singleData, index) in messages" :key="index">
              <img
                style="margin: 0 auto;width: 40px; height:40px"
                :src="'/storage/users/' + singleData.user.id + '/avatars/' + singleData.user.images.avatar.small"
                alt="Avatar"
                class="img-responsive rounded-circle"
                :title="singleData.user.name"
              />
              {{ singleData.message }}
            </li>
          </ul>
        </div>

        <input
          @keydown="sendTypingEvent"
          @keyup.enter="sendMessage"
          v-model="newMessage"
          type="text"
          name="message"
          placeholder="Enter your message"
          class="form-control"
        />
      </div>
      <span class="text-muted" v-if="activeUser">{{ activeUser.name }} is typing...</span>
    </div>

    <div class="col-4">
      <div class="card card-default">
        <div class="card-header">Active Users</div>
        <div class="card-body">
          <ul>
            <li class="py-2" v-for="(user, index) in users" :key="index">{{ user.name }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {
      messages: "",
      newMessage: "",
      users: [],
      activeUser: false,
      typingTimer: false
    };
  },
  created() {
    this.fetchMessages();

    Echo.join("chat")
      .here(user => {
        console.log("here tuuuu");
        this.users = user;
      })
      .joining(user => {
        console.log("join tuuuu");
        this.users.push(user);
      })
      .leaving(user => {
        console.log("leaving tuuuu");
        this.users = this.users.filter(u => u.id != user.id);
      })
      .listen("MessageSent", event => {
        console.log("listen !!!!!!!");
        this.messages.push(event.message);
      })
      .listenForWhisper("typing", user => {
        this.activeUser = user;

        if (this.typingTimer) {
          clearTimeout(this.typingTimer);
        }

        this.typingTimer = setTimeout(() => {
          this.activeUser = false;
        }, 3000);
      });
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user"
    })
  },
  methods: {
    fetchMessages() {
      axios.get("api/auth/messages").then(response => {
        this.messages = response.data;
      });
    },
    sendMessage() {
      this.messages.push({
        user: this.user,
        message: this.newMessage
      });

      axios.post("api/auth/messages", {
        message: this.newMessage,
        user: this.user.id
      });

      this.newMessage = "";
    },
    sendTypingEvent() {
      Echo.join("chat").whisper("typing", this.user);
    }
  }
};
</script>'

<style>
.dropdown-menu {
  max-height: 300px;
  overflow-x: hidden;
  min-width: 20rem;
}
</style>