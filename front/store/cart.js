export const actions = {
  async addToCart (_, id) {
    try {
      const form = new FormData()
      form.set('id', id)
      await this.$axios.post('/api/basket/add', form)
      await this.$auth.fetchUser()
    } catch ({ message }) {
      this.$notify(message)
    }
  },
  async removeFromCart (_, id) {
    try {
      const form = new FormData()
      form.set('rowid', id)
      await this.$axios.post('/api/basket/remove', form)
      await this.$auth.fetchUser()
    } catch ({ message }) {
      this.$notify(message)
    }
  },
  async fetchCart () {
    try {
      const { data: { data } } = await this.$axios.get('/api/basket')
      return data
    } catch (error) {
      throw new Error(error)
    }
  },
  async buyWorks (_, payload) {
    try {
      const form = new FormData()
      if (payload && payload.length > 0) {
        payload.forEach((element, i) => {
          form.append(`work[${i}]`, element.id)
        })
      }
      const { data } = await this.$axios.post('/api/orders', form)
      return data
    } catch (error) {
      throw new Error(error)
    }
  }
}
