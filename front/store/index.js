/* eslint-disable no-useless-catch */
export const state = () => ({
  menu: [],
  footer: [],
  social: [],
  phone: null,
  email: null,
  authFormVisible: false
})

export const mutations = {
  setMenu (state, payload) {
    state.menu = payload
  },
  setFooter (state, payload) {
    state.footer = payload
  },
  setSocial (state, payload) {
    state.social = payload
  },
  setEmail (state, payload) {
    state.email = payload
  },
  setPhone (state, payload) {
    state.phone = payload
  },
  openAuthForm (state) {
    state.authFormVisible = true
  },
  closeAuthForm (state) {
    state.authFormVisible = false
  }
}
export const actions = {
  async  fetchMenu ({ commit }) {
    const { data: { data } } = await this.$axios.get('/api/menu')

    commit('setMenu', data)
    return data
  },
  async  fetchFooter ({ commit }) {
    const { data } = await this.$axios.get('/api/menu/footer')
    commit('setPhone', data.phone)
    commit('setEmail', data.email)
    commit('setFooter', data.data)
    return data
  },
  async fetchSocial ({ commit }) {
    const { data: { data } } = await this.$axios.get('/api/pages/social')

    commit('setSocial', data)
    return data
  },
  async getOtherSites () {
    const { data: { data } } = await this.$axios.get('/api/contacts/country')
    return data
  }

}

export const getters = {
  getMenu: state => state.menu,
  getFooterMenu: state => state.footer,
  getSocial: state => state.social,
  getPhone: state => state.phone,
  getEmail: state => state.email,
  getAuthFormVisible: state => state.authFormVisible
}
