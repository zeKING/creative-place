<template>
  <section class="chat">
    <client-only>
      <CoolLightBox :items="items" :index="index" @close="index = null" />
    </client-only>
    <div class="header-chat">
      <i class="icon fa fa-user" aria-hidden="true" />
      <p class="name">
        {{ getUserData.companion && getUserData.companion.name }}
      </p>
      <!-- <i
        class="icon clickable fa fa-close right"
        aria-hidden="true"
        @click="$emit('close')"
      /> -->
    </div>
    <div id="messages" class="messages-chat">
      <div v-for="(item, index) of messages" :key="item.id">
        <div class="message">
          <div
            v-if="id != item.sender"
            class="photo"
            :style="{
              backgroundImage: `url(${
                getUserData.companion.photo
                  ? getUserData.companion.photo
                  : require('~/assets/images/avatar.svg')
              })`,
            }"
          >
            <!-- <div class="online" /> -->
          </div>
          <div v-if="id == item.sender" class="response">
            <p v-if="item.type == 'text'" class="text">
              {{ item.text }}
            </p>
            <img
              v-if="item.type == 'file'"
              class="file"
              :src="item.text"
              alt="photo"
              @click="onClickImage(item, index)"
            >
          </div>
          <div v-else>
            <p v-if="item.type == 'text'" class="text">
              {{ item.text }}
            </p>
            <img
              v-if="item.type == 'file'"
              class="file"
              :src="item.text"
              alt="photo"
              @click="onClickImage(item, index)"
            >
          </div>
        </div>
        <p class="time" :class="{ response: item.sender == id }">
          <timeago :datetime="item.createdAt" />
        </p>
      </div>
    </div>
    <div class="footer-chat">
      <i
        class="icon fa fa-file clickable"
        style="font-size: 25pt"
        @click="onClickFile"
      />
      <input ref="file" type="file" class="input-file" @change="onChangeFile">
      <input
        v-model.trim="text"
        type="text"
        class="write-message"
        placeholder="Type your message here"
        @keydown.enter="sendMessage"
      >
      <i
        class="icon send fa fa-paper-plane clickable"
        aria-hidden="true"
        @click="sendMessage"
      />
    </div>
  </section>
</template>

<script>
import io from 'socket.io-client'
// import { nanoid } from 'nanoid'
import { mapGetters } from 'vuex'
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
export default {
  components: {
    CoolLightBox
  },
  props: {
    // socket: {
    //   type: Object,
    //   required: true
    // }
  },
  data () {
    return {
      discussions: [],
      messages: [],
      socket: null,
      message: {},
      text: '',
      id: '1',
      file: null,
      index: null,
      items: []
    }
  },
  computed: {
    ...mapGetters('chat', ['getRoomId', 'getUserData', 'getMessages'])
  },
  mounted () {
    this.socket = io(process.env.SOCKET_URL)
    this.messages = this.getMessages
    this.socket.emit('addUser', this.$auth.user.user_id)
    this.id = this.$auth.user.user_id

    this.message = {
      conversationId: this.getUserData._id,
      sender: this.$auth.user.user_id
    }
    this.socket.on('getMessage', ({ senderId, text, type }) => {
      this.messages.push({
        sender: senderId,
        text,
        type,
        createdAt: Date.now()
      })
    })
    // console.log(this.$refs.messages.scrollHeight)
    // console.log(this.$refs.messages.scrollTop)
    const element = document.getElementById('messages')
    element.scrollTop = element.scrollHeight
    console.dir(element.scrollHeight)
  },
  beforeDestroy () {
    this.$store.commit('chat/CHAT_HIDDEN')
  },
  methods: {
    async sendMessage (e) {
      e.preventDefault()
      if (!this.text) {
        return
      }
      try {
        this.message.text = this.text
        this.message.type = 'text'
        await this.$axios.post('/chat/messages', this.message)
        this.socket.emit('sendMessage', {
          senderId: this.$auth.user.user_id,
          receiverId: this.getUserData.companion.id,
          type: 'text',
          text: this.text
        })
        this.messages = [
          ...this.messages,
          {
            sender: this.$auth.user.user_id,
            text: this.text,
            type: 'text',
            createdAt: Date.now()
          }
        ]
        this.text = ''
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    onClickFile () {
      this.$refs.file.click()
    },
    async onChangeFile (e) {
      this.file = e.target.files[0]
      try {
        const form = this.toFormData({ file: this.file })
        const {
          data: { url }
        } = await this.$axios.post('/chat/upload', form)
        this.message.text = url
        this.message.type = 'file'
        await this.$axios.post('/chat/messages', this.message)
        this.socket.emit('sendMessage', {
          senderId: this.$auth.user.user_id,
          receiverId: this.getUserData.companion.id,
          type: 'file',
          text: url
        })
        this.messages = [
          ...this.messages,
          {
            sender: this.$auth.user.user_id,
            text: url,
            type: 'file',
            createdAt: Date.now()
          }
        ]
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    onClickImage (item) {
      this.items = [{ ...item, src: item.text }]
      console.log(this.items)
      this.index = 0
    }
  }
}
</script>

<style scoped>
.discussions {
  width: 35%;
  height: 700px;
  box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  display: inline-block;
}
@media (max-width: 1200px) {
  .discussions {
    width: 30%;
  }
}

.discussions .discussion {
  width: 100%;
  height: 90px;
  background-color: #fafafa;
  border-bottom: solid 1px #e0e0e0;
  display: flex;
  align-items: center;
  cursor: pointer;
}

.discussions .search {
  display: flex;
  align-items: center;
  justify-content: center;
  color: #e0e0e0;
}

.discussions .search .searchbar {
  height: 40px;
  background-color: #fff;
  width: 70%;
  padding: 0 20px;
  border-radius: 50px;
  border: 1px solid #eeeeee;
  display: flex;
  align-items: center;
  cursor: pointer;
}

.discussions .search .searchbar input {
  margin-left: 15px;
  height: 38px;
  width: 100%;
  border: none;
  font-family: "Montserrat", sans-serif;
}

.discussions .search .searchbar *::-webkit-input-placeholder {
  color: #e0e0e0;
}
.discussions .search .searchbar input *:-moz-placeholder {
  color: #e0e0e0;
}
.discussions .search .searchbar input *::-moz-placeholder {
  color: #e0e0e0;
}
.discussions .search .searchbar input *:-ms-input-placeholder {
  color: #e0e0e0;
}

.discussions .message-active {
  width: 100%;
  height: 90px;
  background-color: #fff;
  border-bottom: solid 1px #e0e0e0;
}

.discussions .discussion .photo {
  margin-left: 20px;
  display: block;
  width: 45px;
  height: 45px;
  flex: 0 0 45px;
  background: #e6e7ed;
  -moz-border-radius: 50px;
  -webkit-border-radius: 50px;
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
}

.online {
  position: relative;
  top: 30px;
  left: 35px;
  width: 13px;
  height: 13px;
  background-color: #8bc34a;
  border-radius: 13px;
  border: 3px solid #fafafa;
}

.desc-contact {
  height: 43px;
  width: 50%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.discussions .discussion .name {
  margin: 0 0 0 20px;
  font-family: "Montserrat", sans-serif;
  font-size: 11pt;
  color: #515151;
}

.discussions .discussion .message {
  margin: 6px 0 0 20px;
  font-family: "Montserrat", sans-serif;
  font-size: 9pt;
  color: #515151;
}

.timer {
  margin-left: 15%;
  font-family: "Open Sans", sans-serif;
  font-size: 11px;
  padding: 3px 8px;
  color: #bbb;
  background-color: #fff;
  border: 1px solid #e5e5e5;
  border-radius: 15px;
}

.chat {
  width: calc(65% - 85px);
  /* overflow-y: scroll; */
}

.header-chat {
  width: 150%;
  background-color: #f07810;
  height: 90px;
  box-shadow: 0px 3px 2px rgba(0, 0, 0, 0.1);
  display: flex;
  align-items: center;
}
.chat .header-chat .icon {
  margin-left: 30px;
  color: #515151;
  font-size: 14pt;
}

.chat .header-chat .name {
  margin: 0 0 0 20px;
  text-transform: uppercase;
  font-family: "Montserrat", sans-serif;
  font-size: 13pt;
  color: #515151;
}

.chat .header-chat .right {
  position: absolute;
  right: 40px;
}

.chat .messages-chat {
  padding: 25px 35px;
  height: calc(95vh - 120px);
  display: flex;
  flex-direction: column;
  overflow-y: scroll;
}

.chat .messages-chat .message {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
}

.chat .messages-chat .message .photo {
  display: block;
  width: 45px;
  height: 45px;
  flex: 0 0 45px;
  background: #e6e7ed;
  -moz-border-radius: 50px;
  -webkit-border-radius: 50px;
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
}

.chat .messages-chat .text {
  margin: 0 35px;
  background-color: #f6f6f6;
  padding: 15px;
  border-radius: 12px;
  overflow-wrap: anywhere;
  max-width: 500px;
}
.chat .messages-chat .message img {
  cursor: pointer;
  margin: 0 0 0 35px;
}
.text-only {
  margin-left: 45px;
}

.time {
  font-size: 10px;
  color: lightgrey;
  margin-bottom: 10px;
  margin-left: 85px;
}

.response-time {
  float: right;
  margin-right: 40px !important;
}

.response {
  float: right;
  margin-right: 0px !important;
  margin-left: auto; /* flexbox alignment rule */
}

.response .text {
  background-color: #fdecdd !important;
  overflow-wrap: anywhere;
  max-width: 500px;
}

.footer-chat {
  width: calc(65% - 66px);
  height: 80px;
  display: flex;
  align-items: center;
  position: absolute;
  bottom: 0;
  background-color: #fff;
  /* background-color: transparent; */
  border-top: 2px solid #eee;
}

.footer-chat .icon {
  margin-left: 30px;
  color: #c0c0c0;
  font-size: 14pt;
}

.footer-chat .send {
  color: #fff;
  position: absolute;
  right: 50px;
  padding: 15px;
  border-radius: 50%;
  font-size: 12px;
  background-color: #f07810;
  display: flex;
  align-items: center;
  justify-content: center;
}

.chat .footer-chat .name {
  margin: 0 0 0 20px;
  text-transform: uppercase;
  font-family: "Montserrat", sans-serif;
  font-size: 13pt;
  color: #515151;
}

.chat .footer-chat .right {
  position: absolute;
  right: 40px;
}

.write-message {
  border: none !important;
  width: 60%;
  height: 50px;
  margin-left: 20px;
  padding: 10px;
}

.footer-chat *::-webkit-input-placeholder {
  color: #c0c0c0;
  font-size: 13pt;
}
.footer-chat input *:-moz-placeholder {
  color: #c0c0c0;
  font-size: 13pt;
}
.footer-chat input *::-moz-placeholder {
  color: #c0c0c0;
  font-size: 13pt;
  margin-left: 5px;
}
.footer-chat input *:-ms-input-placeholder {
  color: #c0c0c0;
  font-size: 13pt;
}

.clickable {
  cursor: pointer;
}
.modal-dialog-centered {
  margin: 0 auto;
}
.blue {
  color: blue;
}
.input-file {
  display: none;
}
.file {
  width: 60px;
  height: 60px;
}

/* @media (min-width:768.98px) and (max-width:1200px) {
  .footer-chat {
    height: calc(40px + 30 * (100vw / 1200));
  }
  .footer-chat .icon.fa-file::before {
    display: flex;
    font-size: calc(12px + 10 * (100vw / 1200)) !important;
  }
} */
/* @media (min-width:768.98px) and  (max-width:1200px) {
  .header-chat {
    height: calc(10px + 50 * ( 100vw / 1200));
  }
  .chat {
    width: calc(65% - 50px) !important;
  }
} */
@media (max-width: 570.98px) {
  .header-chat {
    height: calc(10px + 50 * (100vw / 570));
    width: 86%;
    background-color: #fff;
    box-shadow: none;
    box-shadow: 0px 3px 2px rgb(0 0 0 / 10%);
  }
  .chat {
    width: calc(65% - 10px) !important;
  }
  .chat .messages-chat {
    padding: 0 0 0 10px;
  }
  .chat .messages-chat .text {
    margin: 0 8px;
  }
  .discussions .discussion {
    height: calc(10px + 50 * (100vw / 570));
  }
}
@media (min-width: 570.98px) {
  .header-chat > .icon,
  .header-chat > .name {
    color: #fff !important;
  }
}

@media (max-width: 570.98px) {
  .discussions .message-active {
    height: 70px;
  }
  .discussions {
    width: 20%;
  }
  .desc-contact {
    display: none;
  }
  .footer-chat {
    width: calc(100% - 50px);
    height: 70px;
  }
}
</style>
