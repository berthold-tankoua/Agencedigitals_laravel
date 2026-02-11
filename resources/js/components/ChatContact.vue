<template>
  <div class="row">
    <!-- Liste des utilisateurs -->
    <div class="col-md-12 myUser">
      <ul class="user">
        <h6>💬 Liste des conversations</h6>
        <hr />
        <li v-for="(user, index) in users" :key="index">
          <a @click.prevent="goToChat(user.id)" class="d-flex align-items-center">
            <img
              v-if="user.role === 'user'"
              :src="'/upload/no_image.jpg'"
              alt="UserImage"
              class="userImg me-2"
            />
            <img
              v-else
              :src="'/upload/agent.webp'"
              alt="UserImage"
              class="userImg me-2"
            />
            <div>
              <p class="username text-left">{{ user.name }} <span v-if="user.unread_count > 0" class="badges">{{ user.unread_count }}</span></p>
              <span class="text-secondary">En ligne : {{ user.last_seen }}</span>
            </div>
          </a>
          <hr />
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      allmessages: {},
      selectedUser: null,
      msg: "",
      showChat: false,
      windowWidth: window.innerWidth,
    };
  },

  created() {
    this.getAllUser();

    // Rafraîchir les messages toutes les ?s si un utilisateur est sélectionné
    setInterval(() => {
        this.getAllUser();
    }, 30000);

  },

  methods: {

    getAllUser() {
      axios
        .get("/user-all")
        .then((res) => {
          this.users = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },

    formatDate(dateString) {
      const options = {
        month: "short",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
      };
      return new Date(dateString).toLocaleDateString("fr-FR", options);
    },

    goToChat(userId) {
       window.location.href = `/user/chat/details/${userId}`;
    }

  },
};
</script>

<style>
.username {
  color: #000;
}

.myrow {
  background: #f3f3f3;
  padding: 25px;
}

.myUser {
  padding-top: 30px;
  overflow-y: scroll;
  height: 450px;
  background: #f2f6fa;
}
.user li {
  list-style: none;
  margin-top: 20px;
}

.user li a:hover {
  text-decoration: none;
  color: red;
}
.userImg {
  height: 35px;
  border-radius: 50%;
}
.chat {
  list-style: none;
  margin: 0;
  padding: 0;
}

.chat li {
  margin-bottom: 5px;
  padding-bottom: 5px;
  margin-top: 20px;
  width: 80%;
}

.chat li .chat-body p {
  margin: 0;
}

.chat-msg {
  overflow-y: scroll;
  height: 350px;
  background: #f2f6fa;
}
.chat-msg .chat-img {
  width: 100px;
  height: 100px;
}
.chat-msg .img-circle {
  border-radius: 50%;
}
.chat-msg .chat-img {
  display: inline-block;
}
.chat-msg .chat-body {
  display: inline-block;
  max-width: 95%;
  margin-right: -73px;
  background-color: rgb(217, 253, 211);
  border-radius: 12.5px;
  padding: 15px;
}
.chat-msg .chat-body2 {
  display: inline-block;
  max-width: 80%;
  margin-left: -64px;
  background-color: rgb(255, 255, 255);
  border-radius: 12.5px;
  padding: 15px;
}
.chat-msg .chat-body strong {
  color: #0169da;
}

.chat-msg .buyer {
  text-align: right;
  float: right;
}
.chat-msg .buyer p {
  text-align: left;
}
.chat-msg .sender {
  text-align: left;
  float: left;
}
.chat-msg .left {
  float: left;
}
.chat-msg .right {
  float: right;
}

.clearfix {
  clear: both;
}

.badges {
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: bold;
}

@media (max-width: 767px) {
  .myUser {
    width: 100%;
  }
  .myChat {
    width: 100%;
  }
  .chat-msg .chat-body {
    display: inline-block;
    max-width: 100%;
    margin-right: 1px;
  }
  .chat-msg .chat-body2 {
    display: inline-block;
    max-width: 100%;
    margin-left: 1px;
  }
  .chat-msg .chat-img {
    display: none;
  }
  .chat li {
    margin-bottom: 5px;
    padding-bottom: 5px;
    margin-top: 20px;
    width: 90%;
  }
}
</style>
