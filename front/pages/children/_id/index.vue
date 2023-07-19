<template>
  <div v-if="isLoaded">
    <ChildrenMain class="home" :form="form" />
    <AppGallery :form="form" :images="works" :send-message="true" @clickImage="toPage" />
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      form: {},
      works: [],
      isLoaded: false
    }
  },
  async mounted () {
    try {
      this.form = await this.fetchDetail(
        this.$route.params.id
      )
      this.works = this.form && this.form.works
      this.works = this.works.map(item => ({ ...item, photo: item.file }))
      delete this.form.works
    } catch ({ message }) {
      this.$notify(message)
    } finally {
      this.isLoaded = true
    }
  },
  methods: {
    ...mapActions('profile', ['fetchProfile']),
    ...mapActions('children', ['fetchDetail']),
    toPage (id) {
      this.$router.push(`/children/${this.$route.params.id}/` + id)
    }

  }
}
</script>
