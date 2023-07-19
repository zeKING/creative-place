<template>
  <main v-if="detail" class="childrens-page">
    <!-- pictures-abut -->
    <client-only>
      <CoolLightBox
        ref="lightbox"
        :items="items"
        :index="index"
        @close="index = null"
      />
    </client-only>
    <section class="picture-about">
      <div class="container">
        <div class="container-picture">
          <div class="picture-content">
            <img :src="detail.img" alt="picture" @click="onClickImage">
          </div>
          <div class="picture-text">
            <div class="picture-text-content">
              <h2>{{ detail.tag_id && detail.tag_id.title }}</h2>
              <h5>{{ detail.name }}</h5>
              <p v-html="detail.text" />
            </div>
            <div class="picture-buy">
              <div>
                <p>Цена</p>
                <h3>{{ detail.price }} сум</h3>
              </div>
              <div>
                <button class="btn picture-btn" @click="pushToCart($route.params.projectId || $route.query.id)">
                  Добавить в корзину<i class="fa-solid fa-cart-shopping" />
                </button>
                <button class="btn picture-btn" @click="addFavorite(detail)">
                  добавить в избранные<i class="fa-solid fa-star" />
                </button>
                <button
                  class="btn picture-btn"
                  type="button"
                  @click="openModal('chatVisible')"
                >
                  Отправить сообщение<i class="fa-solid fa-envelope" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <AppUiModalChat v-if="chatVisible" @close="closeModal" />
  </main>
</template>

<script>
import { mapActions, mapMutations } from 'vuex'
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
export default {
  components: {
    CoolLightBox
  },
  props: {
    detail: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      chatVisible: false,
      LoginFormVisible: false,
      items: [],
      index: null

    }
  },
  mounted () {
  },
  methods: {
    ...mapActions('cart', ['addToCart', 'removeFromCart']),
    ...mapActions('projects', ['addToFavorite', 'removeFavorite']),
    ...mapMutations(['openAuthForm']),
    async addFavorite (item) {
      try {
        if (!this.$auth.user) {
          this.openAuthForm()
          return ''
        }
        const id = this.$route.params.projectId || this.$route.query.id
        const form = this.toFormData({ work_id: id, user_id: this.$auth.user.user_id })
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
    openModal () {
      if (!this.$auth.user) {
        this.openAuthForm()
        return ''
      }
      this.chatVisible = true
      this.$route.query.user = this.detail?.user?.user_id
    },
    closeModal () {
      this.chatVisible = false
      this.LoginFormVisible = false
    },
    onClickImage () {
      this.items = [{ src: this.detail.img }]

      this.index = 0
    },
    async pushToCart (id) {
      if (!this.$auth.user) {
        this.openAuthForm()
        return ''
      }
      await this.addToCart(id)
    }

  }
}
</script>
