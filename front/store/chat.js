export const state = () => ({
  roomId: null,
  userData: null,
  chatVisible: false,
  socket: null,
  messages: []
})
export const mutations = {
  SET_ROOM_ID (state, roomId) {
    state.roomId = roomId
  },
  SET_USER_DATA (state, payload) {
    state.userData = payload
  },
  CHAT_VISIBLE (state) {
    state.chatVisible = true
  },
  CHAT_HIDDEN (state) {
    state.chatVisible = false
  },
  SET_SOCKET (state, payload) {
    state.socket = payload
  },
  setMessages (state, payload) {
    state.messages = payload
  }

}
export const actions = {
  async fetchProfile ({ commit }, payload) {
    try {
      const form = new FormData()
      form.set('user_id', payload)
      const { data: { data } } = await this.$axios.post('/api/user/detail/' + payload)
      commit('SET_USER_DATA', data)
      return data
    } catch (error) {
      console.error(error)
      throw error
    }
  },
  async fetchMessages ({ commit }, payload) {
    try {
      const { data } = await this.$axios.get('/chat/messages/' + payload)
      commit('setMessages', data)
    } catch ({ message }) {
      this.$notify(message)
    }
  }
}
export const getters = {
  getRoomId: state => state.roomId,
  getUserData: state => state.userData,
  getChatVisible: state => state.chatVisible,
  socket: state => state.socket,
  getMessages: state => state.messages
}
