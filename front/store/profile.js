/* eslint-disable no-useless-catch */
export const state = () => ({
  phone: null,
})
export const actions = {
  async fetchProfile(_, payload) {
    const form = new FormData()
    Object.entries(payload).forEach(([key, value]) => {
      form.append(key, value)
    })
    const { data: { data } } = await this.$axios.post('/api/user/profile', form)
    return data
  },
  async fetchTags() {
    try {
      const { data: { data } } = await this.$axios.get('/api/tags/all')
      return data
    } catch (error) {
      throw new Error(error)
    }
  },
  async addWork(_, form) {
    try {
      const { data } = await this.$axios.post('/api/works/save', form)
      return data
    } catch (error) {
      throw new Error(error)
    }
  },
  async userUpdate(_, form) {
    try {
      await this.$axios.post('/api/user/edit', form)
    } catch (error) {
      throw error
    }
  },
  async changePhone(_, payload) {
    try {
      await this.$axios.post('/api/user/changePhone', payload)
    } catch (error) {
      throw error
    }
  },
  async confirmChangePhone(_, payload) {
    try {
      await this.$axios.post('/api/user/changePhoneVerify', payload)
    } catch (error) {
      throw error
    }
  },
  async changePassword(_, payload) {
    try {
      await this.$axios.post('/api/user/changePassword', payload)
    } catch (error) {
      throw error
    }
  }
}

export const mutations = {
  SET_USER_PHONE(state, payload) {
    state.phone = payload
  },
}
export const getters = {
  getPhoneNumber: state => state.phone,
}
