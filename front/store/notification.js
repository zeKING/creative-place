export const actions = {
  async fetchNotification (_, id) {
    try {
      const { data: { data } } = await this.$axios.get('/api/notification/get', {
        params: {
          user_id: id
        }
      })
      return data
    } catch (error) {
      throw new Error(error)
    }
  },
  async  removeNotification (_, id) {
    try {
      const form = new FormData()
      form.set('id', id)
      await this.$axios.post('/api/notification/delete', form)
    } catch (error) {
      console.log(error)
      throw error
    }
  }

}
