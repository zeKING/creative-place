<template>
  <section class="discussions">
    <div class="discussion search">
      <div class="searchbar">
        <i class="fa fa-search" aria-hidden="true" />
        <input type="text" placeholder="Search...">
      </div>
    </div>
    <div
      v-for="item of discussions"
      :key="item.id"
      class="discussion message-active"
      @click="setMessage(item)"
    >
      <div
        class="photo"
        :style="{
          backgroundImage: `url(${
            item.companion.photo
              ? item.companion.photo
              : require('~/assets/images/avatar.svg')
          })`,
        }"
      >
        <!-- <div class="online" /> -->
      </div>
      <div class="desc-contact">
        <p class="name">
          {{ item.companion.name }}
        </p>
        <p class="message">
          {{ item.companion.lastChat }}
        </p>
      </div>
      <!-- <div class="timer">
        {{ item.companion. }}
      </div> -->
    </div>
  </section>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  props: {
    // socket: {
    //   type: Object,
    //   required: true
    // }
  },
  data () {
    return {
      discussions: [],
      user: {},
      id: '1'
    }
  },
  computed: {
    ...mapGetters('chat', ['getUserData'])
  },

  async mounted () {
    const senderId = this.$auth.user.user_id
    const receiverId = this.$route.query.user

    if (this.$route.query.user) {
      try {
        await this.fetchProfile(this.$route.query.user)
        const { data } = await this.$axios.post('/chat/conversations/', {
          senderId,
          receiverId,
          users: [
            {
              name: this.getUserData.name,
              photo: this.getUserData.photo,
              id: this.$route.query.user
            },
            {
              name: this.$auth.user.name,
              photo: this.$auth.user.photo,
              id: this.$auth.user.user_id
            }
          ]
        })
        // eslint-disable-next-line eqeqeq
        data.companion = data.users.find(i => i.id != this.$auth.user.user_id)
        this.$store.commit('chat/CHAT_HIDDEN')
        this.$store.commit('chat/SET_USER_DATA', data)
        await this.fetchMessages(data._id)
        this.$store.commit('chat/CHAT_VISIBLE')
      } catch ({ message }) {
        console.log(message)
        this.$notify(message)
      }
    }
    // this.$store.commit('chat/SET_SOCKET', this.socket)
    this.discussions = await this.getUsers()
  },
  methods: {
    ...mapActions('chat', ['fetchProfile', 'fetchMessages']),
    async setMessage (item) {
      this.$store.commit('chat/CHAT_HIDDEN')
      this.$store.commit('chat/SET_USER_DATA', item)
      await this.fetchMessages(item._id)
      this.$store.commit('chat/CHAT_VISIBLE')
    },
    async getUsers () {
      try {
        const { data } = await this.$axios.get(
          '/chat/conversations/' + this.$auth.user.user_id
        )
        data.forEach((element) => {
          // eslint-disable-next-line eqeqeq
          element.companion = element.users.find(
            i => i.id != this.$auth.user.user_id
          )
        })
        return data
      } catch ({ message }) {
        this.$notify(message)
      }
    }
  }
}
</script>

<style scoped>
.discussions {
  width: 35%;
  height: 100vh;
  box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  display: inline-block;
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
@media (max-width: 570.98px) {
  .discussions .discussion {
    height: calc(10px + 50 * (100vw / 570));
  }
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
  width: 98.5%;
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
}

.header-chat {
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
  overflow: scroll;
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
  background-color: #e3effd !important;
}

.footer-chat {
  width: calc(65% - 66px);
  height: 80px;
  display: flex;
  align-items: center;
  position: absolute;
  bottom: 0;
  background-color: transparent;
  border-top: 2px solid #eee;
}
.chat .footer-chat .icon {
  margin-left: 30px;
  color: #c0c0c0;
  font-size: 14pt;
}

.chat .footer-chat .send {
  color: #fff;
  position: absolute;
  right: 50px;
  padding: 12px 12px 12px 12px;
  border-radius: 50px;
  font-size: 14pt;
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
