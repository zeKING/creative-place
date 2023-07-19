<template>
  <div
    id="staticBackdrobells"
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
            {{ $t('Basket') }}
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
          <div class="korzinka">
            <div class="korzinka_left">
              <div class="korzinka_left_top">
                <div>
                  <img src="~/assets/images/mins.png" alt="">
                  <p>Выбрать все</p>
                </div>
                <p>Удалить выбранные</p>
              </div>
              <div class="korzinka_left_scroll">
                <div v-for="item of products" :key="item.id" class="korzinka_left_scroll_card">
                  <div class="korzinka_left_scroll_card_left">
                    <div
                      class="custom-control custom-checkbox my-1 mr-sm-2"
                    >
                      <input
                        id="customControlInline"
                        type="checkbox"
                        class="custom-control-input"
                      >
                      <label
                        class="custom-control-label"
                        for="customControlInline"
                      />
                    </div>
                    <img :src="item.file" alt="">
                    <div
                      class="korzinka_left_scroll_card_left_data"
                    >
                      <h6>{{ item.name }}</h6>
                      <p>{{ item.user_name }}</p>
                      <h4>{{ item.price }} {{ $t('sum') }}</h4>
                    </div>
                  </div>
                  <div class="korzinka_left_scroll_card_right">
                    <div
                      class="korzinka_left_scroll_card_right_top"
                    >
                      <span @click="decrement(item)">
                        <img src="~/assets/images/m.png" alt="">
                      </span>
                      <p>{{ item.qty }}</p>
                      <span @click="increment(item)">
                        <img src="~/assets/images/p.png" alt="">
                      </span>
                    </div>
                    <div
                      class="korzinka_left_scroll_card_right_bottom"
                    >
                      <img src="~/assets/images/by.png" alt="" @click="addFavorite(item)">
                      <img src="~/assets/images/dlt.png" alt="" @click="onDelete(item.rowid)">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="korzinka_right">
              <div>
                <h4>Итого</h4>
                <h4>{{ formatPrice(getPrice) }} {{ $t('sum') }}</h4>
              </div>
              <div v-for="item of products" :key="item.id">
                <p>{{ item.name }}, {{ item.qty }} шт.</p>
                <p>{{ formatPrice(item.price) }} {{ $t('sum') }}</p>
              </div>

              <button
                type="button"
                @click="onSubmit"
              >
                {{ $t('Buy') }} ({{ getCount }})
              </button>
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
  filters: {
    toCurrency (value) {
      if (typeof value !== 'number') {
        return value
      }
      const formatter = new Intl.NumberFormat('ru-RU', {
        style: 'currency',
        currency: 'SUM'
      })
      return formatter.format(value)
    }
  },
  data () {
    return {
      products: []
    }
  },
  computed: {
    getPrice () {
      let sum = 0
      if (this.products && this.products.length > 0) {
        this.products.forEach((i) => {
          const price = parseInt(i.price, 10)
          sum += (price * i.qty)
        })
        return sum
      } else {
        return 0
      }
    },
    getCount () {
      let count = 0
      if (this.products && this.products.length > 0) {
        this.products.forEach((i) => {
          count += i.qty
        })
        return count
      } else {
        return 0
      }
    }
  },
  async mounted () {
    await this.getProducts()
  },
  methods: {
    ...mapActions('cart', ['fetchCart', 'buyWorks']),
    ...mapActions('projects', ['addToFavorite']),
    async getProducts () {
      try {
        this.products = await this.fetchCart()
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    async increment (item) {
      try {
        const form = this.toFormData({ id: item.id, qty: 1 })
        const { data: { data } } = await this.$axios.post('/api/basket/qty_plus', form)
        item.qty = data.qty
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    async decrement (item) {
      try {
        const form = this.toFormData({ id: item.id, qty: 1 })
        const { data: { data } } = await this.$axios.post('/api/basket/qty_minus', form)
        item.qty = data.qty
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    async onDelete (id) {
      try {
        const form = this.toFormData({ rowid: id })
        await this.$axios.post('/api/basket/remove', form)
        await this.$auth.fetchUser()
        await this.getProducts()
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    async addFavorite (item) {
      try {
        if (!this.$auth.user) {
          return ''
        }
        const form = this.toFormData({ work_id: item.id, user_id: this.$auth.user.user_id })
        await this.addToFavorite(form)
        this.$notify(this.constants.successFavorite)
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    async onSubmit () {
      try {
        if (!this.$auth.user) {
          return ''
        }
        const data = await this.buyWorks(this.products)
        this.$notify(this.constants.successFavorite)
        window.location.href = data.url
      } catch ({ message }) {
        this.$notify(message)
      }
    }
  }

}
</script>

<style>
  .korzinka_left_scroll_card_right_bottom img {
    cursor: pointer
  }
</style>
