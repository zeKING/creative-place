<template>
  <div class="header_nav" :class="{'mobile-menu-active': isMobileMenu, 'menu-btn__active': isMobileMenu}">
    <div class="container">
      <nav>
        <ul>
          <AppRecursive
            v-for="(item, index) in getMenu"
            :key="index"
            :arr="item"
            :title="item.title"
          />
        </ul>

        <!-- <ul>

          <li v-for="(item, index) of getMenu" :key="index">
            <nuxt-link :to="item.link || item.slug">
              {{ item.title }}
            </nuxt-link>
          </li>
        </ul> -->
      </nav>
      <a href="#" class="menu-btn" @click="openMobileMenu">
        <span class="text-dark" />
      </a>
    </div>
    <AppUiMobileMenu @closeMobile="closeMobileMenu" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default {
  data () {
    return {
      isMobileMenu: false
    }
  },
  computed: {
    ...mapGetters(['getMenu'])
  },
  async mounted () {
    if (!(this.getMenu && this.getMenu.length !== 0)) {
      try {
        await this.fetchMenu()
      } catch ({ message }) {
        this.$notify(message)
      }
    }
  },
  methods: {
    ...mapActions(['fetchMenu']),
    openMobileMenu () {
      this.isMobileMenu = !this.isMobileMenu
    },
    closeMobileMenu () {
      this.isMobileMenu = false
    }
  }
}
</script>
