/* eslint-disable no-useless-catch */
export const actions = {
  async fetchData () {
    try {
      const { data: { data } } = await this.$axios.get('/api/contacts/page')
      return data
    } catch (error) {
      throw error
    }
  }
}
