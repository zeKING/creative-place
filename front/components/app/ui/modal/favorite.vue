<template>
  <div
    id="staticBackdro-plus"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="staticBackdropLabel" class="modal-title">
            {{ $t('Favorites') }}
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            @click="$emit('close')"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body centerr">
          <div class="order-container">
            <div class="thead">
              <p class="name">
                {{ $t('Product Name') }}
              </p>
              <p class="summ">
                {{ $t('Price') }}
              </p>
            </div>
            <div class="tbody">
              <div v-for="(item, i) of list" :key="i" class="product">
                <div class="product-img">
                  <img :src="item.file" alt="product">
                  <div class="text">
                    <p>{{ item.tag }}</p>
                    <p>{{ item.name }}</p>
                  </div>
                </div>
                <div class="product-summ">
                  <p>{{ formatPrice(item.price) }} {{ $t('Price') }}</p>
                  <div class="del" @click="removeFromFavorite(item.work_id)">
                    <i class="fa-solid fa-trash" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      list: []
    }
  },
  async mounted () {
    await this.getList()
  },
  methods: {
    ...mapActions('projects', ['fetchFavorite', 'removeFavorite']),
    async getList () {
      try {
        if (!this.$auth.user) {
          return ''
        }
        this.list = await this.fetchFavorite(this.$auth.user.user_id)
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    async removeFromFavorite (id) {
      try {
        if (!this.$auth.user) {
          return ''
        }
        const form = this.toFormData({
          user_id: this.$auth.user.user_id,
          work_id: id
        })
        await this.removeFavorite(form)
        await this.getList()
      } catch ({ message }) {
        this.$notify(message)
      }
    }
  }
}
</script>
