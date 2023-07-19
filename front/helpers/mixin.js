export default {
  data () {
    return {
      constants: {
        successFavorite: 'Успешно добавлен'
      }
    }
  },
  mounted () {
    // this.socket = io('http://localhost:8900')
  },
  methods: {
    toFormData (payload) {
      const form = new FormData()
      Object.entries(payload).forEach(([key, value]) => {
        form.append(key, value)
      })
      return form
    },
    parseJwt (token) {
      try {
        return JSON.parse(atob(token.split('.')[1]))
      } catch (e) {
        return null
      }
    },
    formatPrice (value) {
      const val = (value / 1).toFixed(2).replace('.', ',')
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ')
    }
  },
  filters: {
    formatPhone (phone) {
      return phone.replace(/[^0-9]/g, '')
        .replace(/(\d{3})(\d{2})(\d{3})(\d{2})(\d{2})/, '$1-$2 $3 $4 $5')
    }
  }

}
