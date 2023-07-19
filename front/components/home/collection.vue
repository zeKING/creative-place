<template>
  <section class="collection section-space">
    <div class="container">
      <h2>{{ $t("Collection of children's works") }}</h2>
      <div class="collection-wrapper">
        <div
          v-for="(item, i) of collections"
          :key="i"
          class="collection-card"
          @click="$router.push('/projects?slug=' + item.id)"
        >
          <div class="card-img" style="background-color: #f3f3f3">
            <img
              v-for="(image, index) of item.gallery"
              :key="index"
              :src="image.img"
              alt="collection"
            >
          </div>
          <h4>{{ item.title }}</h4>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  data () {
    return {
      collections: []
    }
  },
  async created () {
    try {
      this.collections = await this.fetchCollections()
    } catch ({ message }) {
      this.$notify(message)
    }
  },
  methods: {
    ...mapActions('home', ['fetchCollections'])
  }
}
</script>
