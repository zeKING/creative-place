/* eslint-disable no-useless-catch */
export const actions = {
  async sendQuestions (_, payload) {
    const form = new FormData()
    Object.entries(payload).forEach(([key, value]) => {
      form.append(key, value)
    })
    const { data } = await this.$axios.post('/api/contacts/feedback', form)
    return data
  },
  async fetchPhones () {
    try {
      const { data: { data } } = await this.$axios.get('/api/contacts/phone')
      return data
    } catch (error) {
      throw error
    }
  }
}
