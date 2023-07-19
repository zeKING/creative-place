export const actions = {
  async fetchChildren () {
    const { data: { data } } = await this.$axios.get('/api/user/usersHome')
    return data
  },
  async fetchCollections () {
    const { data: { data } } = await this.$axios.get('/api/tags')
    return data
  },
  async fetchWorks () {
    const params = {
      limit: 3,
      offset: 0
    }
    const form = new FormData()
    Object.entries(params).forEach(([key, value]) => {
      form.append(key, value)
    })
    await this.$axios.post('/api/works/getWorks', form)
  },
  async fetchMainContent () {
    const { data } = await this.$axios.get('/api/works/slider')
    return data
  },
  async getWorks () {
    const { data: { data } } = await this.$axios.get('/api/works/getWorksHome')
    return data
  }
}
