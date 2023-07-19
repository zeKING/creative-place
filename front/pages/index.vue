<template>
  <div>
    <AppUiLoader v-show="!isLoad" />
    <div v-show="isLoad">
      <HomeMain
        v-if="isVisibleSwiper"
        class="home "
        :text="text"
        :sliders="sliders"
        :items="items"
      />
      <main class="home-page">
        <HomeHelpChildren class="main-children" />
        <HomeCreation />
        <HomeCollection />
        <HomeChildren v-if="false" />
        <HomeForm />
      </main>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  name: 'IndexPage',
  transition: 'home',
  data () {
    return {
      isLoad: false,
      text: '',
      sliders: [],
      items: [],
      isVisibleSwiper: false
    }
  },
  head: {
    title: 'Дар'
  },
  async created () {
    try {
      this.isLoading = true
      const data = await this.fetchMainContent()
      this.text = data.text
      this.sliders = [...data.data]
      this.items = [{ src: this.text.video_url }]
    } catch ({ message }) {
      this.$notify(message)
    } finally {
      this.isLoading = false
      setTimeout(() => {
        this.isVisibleSwiper = true
      }, 500)
    }
  },
  mounted () {
    setTimeout(() => {
      this.isLoad = true
    }, 2000)
  },
  methods: {
    ...mapActions('home', ['fetchMainContent'])
  }
}
</script>

<style>
  .main-children .children-wrapper {
    display: flex;
    justify-content: flex-start;
  }
</style>
