<template>
  <div v-if="!empty" class="home main-projects-page">
    <ChildrenDetail v-if="detail" :detail="detail" />
  </div>
  <div v-else class="home">
    <p class="text-center">
      {{ $t('list empty') }}
    </p>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      detail: null,
      empty: false
    }
  },
  computed: {
    getQuery () {
      if (this.$route.query.id) {
        return this.$route.query.id
      } else {
        return false
      }
    }
  },
  watch: {
    async getQuery (val) {
      if (val) {
        try {
          const { data } = await this.fetchWorkById(val)
          this.prevValue = val
          this.detail = data
        } catch ({ message }) {
          this.$notify(message)
        }
      }
    }
  },
  async mounted () {
    if (this.$route.query.id) {
      try {
        const { data } = await this.fetchWorkById(this.$route.query.id)
        this.detail = data
      } catch ({ message }) {
        this.$notify(message)
      }
    } else {
      this.empty = true
    }
  },
  methods: {
    ...mapActions('children', ['fetchWorkById'])
  }
}
</script>
