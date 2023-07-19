<template>
  <div v-if="detail">
    <ChildrenDetail class="home" :detail="detail" />
    <AppGallery :images="images" @clickImage="toPage" />
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      detail: null,
      images: []
    }
  },
  async mounted () {
    try {
      const { data } = await this.fetchWorkById(this.$route.params.projectId)
      this.detail = data
      const works = await this.getChildrenWorks(this.$route.params.id)
      this.images = works
    } catch ({ message }) {
      this.$notify(message)
    }
  },
  methods: {
    ...mapActions('children', ['fetchWorkById', 'getChildrenWorks']),
    toPage (id) {
      this.$router.push(`/children/${this.$route.params.id}/${id}`)
    }
  }
}
</script>
