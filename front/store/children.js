export const actions = {
  async fetchWorkById (_, id) {
    const { data } = await this.$axios.get('/api/works/view/' + id)
    return data
  },
  async getChildrenWorks (_, id) {
    const form = new FormData()
    form.set('user_id', id)
    const { data: { data } } = await this.$axios.post('/api/works/getMyWorks', form)
    return data
  },
  async fetchChildren () {
    const { data: { data } } = await this.$axios.get('/api/user/users')
    return data
  },
  async fetchDetail (_, id) {
    console.log(id)
    const { data: { data } } = await this.$axios.get('/api/user/detail/' + id)
    return data
  }

}
