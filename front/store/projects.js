/* eslint-disable no-useless-catch */
export const actions = {
  async fetchWorksByTagId (_, params) {
    try {
      const { data } = await this.$axios.get('/api/works/getWorks', {
        params: {
          tag_id: params.id,
          limit: params.limit,
          offset: params.offset
        }
      })
      return data
    } catch (error) {
      console.log(error)
      throw error
    }
  },
  async addToFavorite (_, payload) {
    try {
      const { data: { data } } = await this.$axios.post('/api/favourite/save', payload)
      await this.$auth.fetchUser()
      return data
    } catch (error) {
      console.error(error)
      throw error
    }
  },
  async removeFavorite (_, payload) {
    try {
      const { data: { data } } = await this.$axios.post('/api/favourite/delete', payload)
      await this.$auth.fetchUser()
      return data
    } catch (error) {
      console.error(error)
      throw error
    }
  },
  async fetchFavorite (_, id) {
    try {
      console.log(id, 'ID')
      const { data: { data } } = await this.$axios.get('/api/favourite', {
        params: {
          user_id: id
        }
      })
      return data
    } catch (error) {
      throw error
    }
  }
}
