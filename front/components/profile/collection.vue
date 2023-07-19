<template>
  <div>
    <main class="Collection-page">
      <section class="Buy_creativity_section">
        <div class="container">
          <div class="Buy_creativity_text Buy_creativity_text_2">
            <h2 v-if="isSeller">
              {{ $t('Paintings') }}
            </h2>

            <button
              v-if="isSeller"
              type="button"
              @click="openModal"
            >
              <span>{{ $t('Add a job') }}</span> <i class="fa-solid fa-plus" />
            </button>
          </div>

          <div class="loyalts_block">
            <div
              v-for="(item, index) in works"
              :key="index"
              class="loyalts_block_card"
              :style="{backgroundImage: `url(${item.file})`}"
            >
              <div class="yuldz_1">
                <span>
                  <i class="fa-regular fa-star" />
                </span>
              </div>

              <div class="loyalts_block_hover">
                <div class="xuyt_qma">
                  <div class="loyalts_block_hover_data">
                    <h3>{{ item.tag }}</h3>
                    <p>{{ form.name }}</p>
                    <span>{{ form.age }} {{ $t('years') }}</span>
                  </div>
                  <button type="button">
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
    <AppUiModalAddToCart v-if="modals.addToCartVisible" @close="closeModals" @fetchData="$emit('fetchData')" />
  </div>
</template>

<script>
export default {
  props: {
    works: {
      type: Array,
      required: true
    },
    form: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      modals: {
        addToCartVisible: false
      }
    }
  },
  computed: {
    isSeller () {
      if (this.$auth.user && this.$auth.user.user_type === 'seller') {
        return true
      } else {
        return false
      }
    }
  },
  methods: {
    openModal () {
      this.modals = {
        addToCartVisible: true
      }
    },
    closeModals () {
      this.modals = {
        addToCartVisible: false
      }
    }
  }
}
</script>
