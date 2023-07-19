<template>
  <main class="Collection-page">
    <section class="Buy_creativity_section">
      <div class="container">
        <div class="Buy_creativity_text Buy_creativity_text_2">
          <h2>{{ title }}</h2>
        </div>
        <div v-if="filter" class="d-flex justify-content-end custom-select__input">
          <div>
            <b-form-select v-model="select" @change="onSelect">
              <b-form-select-option :value="null">
                {{ $t('Select a collection') }}
              </b-form-select-option>
              <b-form-select-option v-for="item of tags" :key="item.id" :value="item.id">
                {{ item.title }}
              </b-form-select-option>
            </b-form-select>
          </div>
          <button v-if="isClear" class="btn btn-success" @click="onClear">
            {{ $t('Clear') }}
          </button>
        </div>
        <div class="loyalts_block">
          <div
            v-for="(item, index) of images"
            :key="index"
            class="loyalts_block_card"
            :style="{
              backgroundImage: `url(${item.photo? item.photo: item.file})`
            }
            "
            style="background-position: center;
                background-repeat: no-repeat;
                background-size: cover;"
            @click="$emit('clickImage', item.id)"
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
                  <h3>{{ item.title }}</h3>
                  <p>{{ item.name }}</p>
                  <span>{{ item.age }}</span>
                </div>
                <button type="button" @click.stop="addCart(item.id)">
                  <span>{{ $t('Add to Cart') }}</span>
                  <i class="fa-solid fa-cart-shopping" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import { mapActions, mapMutations } from 'vuex'

export default {
  props: {
    images: {
      type: Array,
      required: true
    },
    filter: {
      type: Boolean,
      default: false
    },
    tags: {
      type: Array,
      default: () => []
    },
    sendMessage: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      isClear: false,
      LoginVisible: false,
      select: null,
      title: 'Все работы'
    }
  },
  watch: {
    select (val) {
      if (val == null) {
        this.title = 'Все работы'
      }
    }
  },
  mounted () {
    if (this.$route.query.slug) {
      this.select = this.$route.query.slug
      if (this.select && this.tags && this.tags.length > 0) {
        const { title } = this.tags.find(i => i.id === this.select)
        this.title = title
        this.isClear = true
      }
    }
  },

  methods: {
    ...mapActions('projects', ['addToFavorite', 'removeFavorite']),
    ...mapActions('cart', ['addToCart']),
    ...mapMutations(['openAuthForm']),
    onSelect (e) {
      this.isClear = true
      if (this.select) {
        const { title } = this.tags.find(i => i.id === this.select)
        this.title = title
      }

      this.$emit('select', e)
    },
    onClear () {
      this.select = null
      this.$emit('clear')
    },

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
    async addCart (id) {
      try {
        if (!this.$auth.user) {
          this.openAuthForm()
          return ''
        }
        await this.addToCart(id)
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    closeModals () {
      this.LoginVisible = false
    },
    openModal () {
      this.LoginVisible = true
    }
  }

}
</script>

<style>
.Collection-page {
  margin: 50px 0 0 0;
}
.loyalts_block_card {
  cursor: pointer
}

.custom-select__input div .custom-select {
    border-radius: 8px;
    width: 100%;
    height: 48px;
    border: 0;
    max-width: 250px;
    box-shadow: 0px 0px 2px rgb(4 9 33 / 3%), 0px 6px 12px rgb(4 9 33 / 8%);

}
.custom-select__input div .custom-select ~ .btn {
  padding: 8px 30px;
}
.custom-select__input div {
  margin:  0 20px 0 0 ;
}

.custom-select__input {
  padding: 0 15px 0 0 ;
}
@media (max-width:991.98px) {
  .custom-select__input {
    justify-content: flex-start !important;
  }
}
@media (min-width:768.98px) {
  .custom-select__input {
    position: absolute;
    right: 0;
    top: 0;
  }
  .Buy_creativity_section .container {
    position:relative
  }
}
</style>
