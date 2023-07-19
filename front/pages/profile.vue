<template>
  <div v-if="form">
    <ProfileMain :form="form" :fetch-data="fetchData" />
    <ProfileCollection :works="works" :form="form" @fetchData="fetchData" />
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  middleware: 'authenticated',
  data () {
    return {
      form: {},
      works: []
    }
  },
  async mounted () {
    await this.fetchData()
  },
  methods: {
    ...mapActions('profile', ['fetchProfile']),
    async  fetchData () {
      try {
        this.form = await this.fetchProfile({
          user_id: 6
        })
        this.works = this.form && this.form.works
        delete this.form.works
      } catch ({ message }) {
        this.$notify(message)
      }
    }
  }
}
</script>
