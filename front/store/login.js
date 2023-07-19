/* eslint-disable camelcase */
export const state = () => ({
  userPhone: null,
  userId: null,
  isLoggedIn: false,
  userPassword: null
})

export const mutations = {
  SET_USER_PHONE (state, phone) {
    state.userPhone = phone
  },
  SET_USER_ID (state, id) {
    state.userId = id
  },
  AUTH_SUCCESS (state) {
    state.isLoggedIn = true
  },
  AUTH_ERROR (state) {
    state.isLoggedIn = false
  },
  SET_USER_PASSWORD (state, password) {
    state.userPassword = password
  }

}

export const actions = {
  async register (_, payload) {
    const form = new FormData()
    Object.entries(payload).forEach(([key, value]) => {
      form.append(key, value)
    })
    const { data } = await this.$axios.post('/api/user/reg', form)
    return data
  },

  async setUserData ({ commit, state }, payload) {
    try {
      const form = new FormData()
      Object.entries(payload).forEach(([key, value]) => {
        form.append(key, value)
      })
      const { data } = await this.$axios.post('/api/user/reg2', form)
      // const { data: { access_token } } = data
      // this.$cookies.set('access_token', access_token)

      const userData = new FormData()
      userData.set('phone', payload.phone)
      userData.set('password', state.userPassword)
      await this.$auth.loginWith('local', {
        data: userData
      })
      commit('AUTH_SUCCESS')
      return data
    } catch (error) {
      commit('AUTH_ERROR')
      throw error
    }
  },
  async confirmCode (_, payload) {
    const { data } = await this.$axios.post('/api/user/verified_phone', payload)
    return data
  },
  async resetPassword ({ commit }, payload) {
    const { data: { data } } = await this.$axios.post('/api/user/forgot_password', payload)
    commit('SET_USER_ID', data.user_id)
    return data
  },
  async fetchSms (_, payload) {
    const { data: { data } } = await this.$axios.post('/api/user/reset_sms', payload)
    return data
  },
  async changePassword (_, payload) {
    const { data: { data } } = await this.$axios.post('/api/user/change_password', payload)
    return data
  }

}
export const getters = {
  getUserPhone: state => state.userPhone,
  getUserId: state => state.userId,
  getUserPassword: state => state.userPassword
}
