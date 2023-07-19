<template>
  <section class="Buy_creativity_section section-space">
    <div class="container">
      <div class="Buy_creativity_text">
        <h2>{{ $t('Buy creativity!') }}</h2>
        <a href="javascript:void(0)" @click.prevent="$router.push('/projects')">
          <span>{{ $t('View all') }}</span>
          <i class="fa-solid fa-arrow-right" />
        </a>
      </div>

      <div class="loyalts_block">
        <div
          v-for="(item, index) in collections"
          :key="index"
          class="loyalts_block_card"
          :style="{backgroundImage: `url(${item.file})`}"
          @click="$router.push('/search?id=' + item.id)"
        >
          <div class="yuldz_1" :class="{favorite: item.favourite}">
            <span @click.stop="addFavorite(item)">
              <svgicon
                class="star"
                name="star"
                width="24"
                height="24"
                color="#000"

                :fill="false"
              />
            </span>
          </div>

          <div class="loyalts_block_hover">
            <div class="xuyt_qma">
              <div class="loyalts_block_hover_data">
                <h3>{{ item.name }}</h3>
                <p>{{ item.user_name }}</p>
                <span>{{ item.user?.age }} лет</span>
              </div>
              <button type="button" @click.stop="pushToCart(item)">
                <span>{{ $t('Add to Cart') }}</span>
                <i class="fa-solid fa-cart-shopping" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions, mapMutations } from 'vuex'

export default {
  data () {
    return {
      collections: [],
      LoginVisible: false
    }
  },
  async mounted () {
    try {
      this.collections = await this.getWorks()
    } catch ({ message }) {
      this.$notify(message)
    }
  },
  methods: {
    ...mapActions('home', ['fetchWorks', 'getWorks']),
    ...mapActions('cart', ['addToCart']),
    ...mapActions('projects', ['addToFavorite', 'removeFavorite']),
    ...mapMutations(['openAuthForm']),
    async addFavorite (item) {
      try {
        if (!this.$auth.user) {
          this.openAuthForm()
          return ''
        }
        const form = this.toFormData({ work_id: item.id, user_id: this.$auth.user.user_id })
        if (!item.favourite) {
          await this.addToFavorite(form)
          item.favourite = true
        } else {
          await this.removeFavorite(form)
          item.favourite = false
        }
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    closeModals () {
      this.LoginVisible = false
    },
    openModal () {
      this.LoginVisible = true
    },
    async pushToCart (item) {
      if (!this.$auth.user) {
        this.openAuthForm()
        return ''
      }
      await this.addToCart(item.id)
    }
  }
}
</script>
