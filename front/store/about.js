/* eslint-disable no-useless-catch */
export const actions = {
  async fetchData () {
    try {
      const { data: { data } } = await this.$axios.get('/api/menu/view/o-nas')
      return data
    } catch (error) {
      throw error
    }
  },
  async fetchStaticData (_, slug) {
    try {
      const { data: { data } } = await this.$axios.get(`/api/menu/view/${slug}`)
      return data
    } catch (error) {
      throw error
    }
  }

}
