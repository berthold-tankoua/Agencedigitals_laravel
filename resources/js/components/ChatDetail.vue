<template>
  <div class="row justify-content-center">
    <!-- Zone de chat -->
    <div class="col-md-12 myChat" v-if="allmessages.user">
      <div class="card">
        <div class="card-header text-center">
          <div>
            <h5>{{ allmessages.user.name }}</h5>
            <p v-if="!allmessages.is_online" class="text-danger">
              En ligne le {{ formatDate(allmessages.user.last_seen) }}
            </p>
            <p v-else><strong class="text-success">En ligne</strong></p>
          </div>
        </div>

        <div class="card-body chat-msg" ref="chatContainer">
          <ul class="chat" v-for="(msg, index) in messages" :key="msg.id">
            <!-- Messages reçus -->
            <li class="sender clearfix" v-if="allmessages.user.id === msg.sender_id">
              <span class="chat-img left clearfix mx-2">
                <img :src="'/upload/agent.webp'" class="userImg" alt="userImg" />
              </span>
              <div class="chat-body2 clearfix">
                <div class="header clearfix">
                  <small class="left text-muted">{{ formatDate(msg.created_at) }}</small>
                </div>
                <p>{{ msg.msg }}</p>
              </div>
            </li>

            <!-- Messages envoyés -->
            <li class="buyer clearfix" v-else>
              <span class="chat-img right clearfix mx-2">
                <img :src="'/upload/no_image.jpg'" class="userImg" alt="userImg" />
              </span>
              <div class="chat-body clearfix">
                <div class="header clearfix">
                  <small class="left text-muted">{{ formatDate(msg.created_at) }}</small>
                </div>
                <p>{{ msg.msg }}</p>
              </div>
            </li>
          </ul>
        </div>

        <div class="card-footer">
          <div class="input-group align-items-center">
            <input
              id="btn-input"
              type="text"
              v-model="msg"
              class="form-control input-sm me-2"
              placeholder="Écrivez votre message..."
              @keyup.enter="sendMsg"
            />
            <span class="input-group-btn">
              <button class="btn btn-primary ml-3" @click.prevent="sendMsg">
                Envoyer
              </button>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["userid"],
  data() {
    return {
      messages: [], // Liste complète des messages
      lastMessageId: 0, // Pour gérer l'incrémentation
      allmessages: {},
      selectedUser: null,
      msg: "",
    };
  },

  created() {
    this.loadAllMessages(this.userid); // Chargement initial
    setInterval(() => {
      if (this.selectedUser) {
        this.fetchNewMessages(this.selectedUser);
      }
    }, 3000); // Polling toutes les 3 secondes
  },

  methods: {
    scrollToBottom() {
      this.$nextTick(() => {
        const container = this.$refs.chatContainer;
        if (container) {
          container.scrollTop = container.scrollHeight;
        }
      });
    },

    // 🔹 Charger tous les messages au premier affichage
    loadAllMessages(userId) {
      axios
        .get(`/user-message/${userId}`)
        .then((res) => {
          this.allmessages = res.data;
          this.messages = res.data.messages;

          if (this.messages.length > 0) {
            this.lastMessageId = this.messages[this.messages.length - 1].id;
          }
          this.selectedUser = userId;
          this.scrollToBottom();
        })
        .catch((err) => console.error(err));
    },

    // 🔹 Récupérer uniquement les nouveaux messages après last_id
    fetchNewMessages(userId) {
      axios
        .get(`/user-message/${userId}?last_id=${this.lastMessageId}`)
        .then((res) => {
          this.allmessages = res.data;

        if (res.data.messages.length > 0) {
            // On filtre uniquement les messages qui ont un ID supérieur à lastMessageId
            const newMessages = res.data.messages.filter(msg => msg.id > this.lastMessageId);

            if (newMessages.length > 0) {
                this.messages.push(...newMessages);
                this.lastMessageId = this.messages[this.messages.length - 1].id;
                this.scrollToBottom();
            }
        }
        })
        .catch((err) => console.error(err));
    },

    sendMsg() {
      if (!this.msg.trim()) return;
      axios
        .post("/send-message", {
          recevier_id: this.selectedUser,
          msg: this.msg,
        })
        .then(() => {
          this.msg = "";
          this.fetchNewMessages(this.selectedUser);
          this.scrollToBottom();
        })
        .catch((err) => console.error(err));
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
