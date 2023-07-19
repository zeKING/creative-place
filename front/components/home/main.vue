<template>
  <div v-show="!isLoading">
    <client-only>
      <CoolLightBox
        ref="lightbox"
        :items="items"
        :index="index"
        @close="index = null"
        @on-open="open"
      />
    </client-only>
    <div class="carusel_home">
      <div class="container">
        <div class="carusel_home_block">
          <div v-if="text" class="carusel_home_block_text">
            <h2 v-html="text.title" />
            <p v-html="text.category_title" />
            <button type="button" @click="onClick">
              {{ text.video_title }}
            </button>
          </div>
          <div
            class="carusel_img"
            @mouseenter="stopSlider"
            @mouseleave="startSlider"
          >
            <span />
            <client-only>
              <swiper
                v-if="sliders && sliders.length"
                ref="swiper"
                :options="swiperOptions"
                class="swiper"
                :slides-per-view="3"
              >
                <swiper-slide v-for="item of sliders" :key="item.id">
                  <div class="swiper-slide" @click="toDetailPage(item)">
                    <img :src="item.file" alt="">
                    <div class="swiper_data">
                      <div class="yuldz" :class="{ favorite: item.favourite }">
                        <span>
                          <client-only>
                            <svgicon
                              class="star"
                              name="star"
                              width="24"
                              height="24"
                              color="#000"
                              :fill="false"
                              @click.stop="addFavorite(item)"
                            />
                          </client-only>
                        </span>
                      </div>
                      <div class="yuldz_btn">
                        <h5>
                          {{ item.name }}
                        </h5>
                        <p>{{ item.user_name }}</p>
                        <button type="button" @click.stop="pushToCart(item)">
                          <span>{{ $t("Add to Cart") }}</span>
                          <i class="fa-solid fa-cart-plus" />
                        </button>
                      </div>
                    </div>
                  </div>
                </swiper-slide>
              </swiper>
            </client-only>

            <div class="ch swiper-button-prev">
              <!-- <i class="fa-solid fa-angle-left"></i> -->
            </div>
            <div class="o swiper-button-next">
              <!-- <i class="fa-solid fa-angle-right"></i> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header_bottom_img_home" />
  </div>
</template>

<script>
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
import { mapActions, mapMutations } from 'vuex'
export default {
  components: {
    CoolLightBox
  },
  props: {
    text: {
      type: Object,
      required: true
    },
    sliders: {
      type: Array,
      required: true
    },
    items: {
      type: Array,
      required: true
    }
  },

  data () {
    return {
      swiperOptions: {
        slidesPerView: 1,
        speed: 700,
        loop: true,
        // pagination: {
        //   el: '.swiper-pagination',
        //   type: 'progressbar'
        // },
        allowTouchMove: false,
        navigation: {
          nextEl: '.swiper-button-prev',
          prevEl: '.swiper-button-next'
        },
        autoplay: {
          delay: 5000,
          disableOnInteraction: false
        },
        observer: true,
        observeParents: true
      },

      index: null,
      isPauseSlider: false,
      isLoading: false,
      LoginVisible: false
    }
  },
  computed: {
    swiper () {
      return this.$refs.swiper.$swiper
    }
  },
  methods: {
    ...mapActions('projects', ['addToFavorite', 'removeFavorite']),
    ...mapActions('cart', ['addToCart']),
    ...mapMutations(['openAuthForm']),
    async addFavorite (item) {
      try {
        if (!this.$auth.user) {
          this.openAuthForm()
          return ''
        }
        const form = this.toFormData({
          work_id: item.id,
          user_id: this.$auth.user.user_id
        })
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
    stopSlider () {
      this.swiper.autoplay.stop()
    },
    startSlider () {
      this.swiper.autoplay.start()
    },
    onClick () {
      this.index = 0
    },
    toDetailPage (item) {
      this.$router.push('/search/?id=' + item.id)
    },
    open (e) {
      document.querySelector('.cool-lightbox-video').play()
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

<style>
.yuldz:hover svg path {
  fill: #fcba03;
  stroke: #fff;
}
.yuldz.favorite svg path {
  fill: #fcba03;
  stroke: #fff;
}
.yuldz svg {
  cursor: pointer;
}
.yuldz span {
  position: relative;
  z-index: 999;
}
.yuldz_btn h5 {
  cursor: pointer;
}
</style>
