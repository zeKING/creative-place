<template>
  <div v-if="isLoad">
    <ProjectsMain class="home main-projects-page" />
    <AppGallery
      :images="images"
      :filter="true"
      :tags="tags"
      @select="onSelect"
      @clear="clear"
      @clickImage="toPage"
    />
   <div class="projects__pagination">
    <pagination v-model="page" :records="count" :per-page="limit" @paginate="onPaginate" />
   </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import Pagination from 'vue-pagination-2'
export default {
  components: {
    Pagination
  },
  data () {
    return {
      images: [],
      tags: [],
      isLoad: false,
      page: 1,
      limit: 10,
      count: 0,
      tag: null
    }
  },
  computed: {
    offset () {
      return (this.page - 1) * this.limit
    }
  },
  async mounted () {
    try {
      this.tags = await this.fetchTags()
      if (this.$route.query.slug) {
        this.onSelect(this.$route.query.slug)
      } else {
        const { data, count } = await this.fetchWorksByTagId({ limit: this.limit, offset: this.offset })
        this.images = data
        this.count = count
      }
    } catch ({ message }) {
      this.$notify(message)
    } finally {
      this.isLoad = true
    }
  },
  methods: {
    ...mapActions('profile', ['fetchTags']),
    ...mapActions('projects', ['fetchWorksByTagId']),
    async onSelect (e) {
      try {
        const { data, count } = await this.fetchWorksByTagId({ id: e, limit: this.limit, offset: this.offset })
        this.images = data
        this.count = count
        this.tag = e
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    async clear () {
      try {
        const { data, count } = await this.fetchWorksByTagId({ limit: this.limit, offset: this.offset })
        this.images = data
        this.count = count
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    toPage (id) {
      this.$router.push('/search/?id=' + id)
    },
    async onPaginate (e) {
      try {
        const { data, count } = await this.fetchWorksByTagId({ id: this.tag, limit: this.limit, offset: this.offset })
        this.images = data
        this.count = count
      } catch ({ message }) {
        this.$notify(message)
      }
    }
  }
}
</script>
<style>
  .main-projects-page {
    background-image: none;
    background-color: #eee !important;
  }
  .projects__pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 30px 0 ;
  }
  .projects__pagination > div nav p {
    display: none;
  }
  .page-item.active .page-link {
    background-color: #f07810 ;
    border-color: #f07810 ;
  }
</style>
