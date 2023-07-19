<template>
  <div class="mobile">
    <div class="mobile-menu" @click="onClick" />
    <div class="mobile-menu-wrapper">
      <!-- <NewHeaderLang /> -->
      <i class="icon-close" @click="closeMobile" />
      <div class="mobile-menu-list">
        <h3>{{ $t('Menu') }}</h3>

        <div
          class="mobile-menu-list-wrapper"
          :class="{ active: isActive, activeSub: isActiveChild }"
        >
          <ul>
            <li v-for="item in getMenu" :key="item.id">
              <span
                v-if="item.submenu && item.submenu.length"
                @click="OpenSub(item)"
              >
                {{ item.title }}
                <i class="fa-solid fa-chevron-right" />
              </span>
              <nuxt-link
                v-else
                :to="
                  localePath({
                    path: defineLink(item),
                  })
                "
              >
                <!-- item && item.sub && item.sub.length ? '' : defineLink(item) -->
                {{ item.title }}
              </nuxt-link>
            </li>
          </ul>
          <ul>
            <li @click="CloseSub">
              <span> <i class="fa fa-angle-left" /> {{ SubMenuTitle }} </span>
            </li>
            <li v-for="item in SubMenu" :key="item.id">
              <span
                v-if="item.submenu && item.submenu.length"
                @click="OpenSubChild(item)"
              >
                {{ item.title }}
                <i class="fa-solid fa-chevron-right" />
              </span>
              <nuxt-link
                v-else
                :to="
                  localePath({
                    path: defineLink(item),
                  })
                "
              >
                {{ item.title }}
              </nuxt-link>
            </li>
            <!-- defineLink(item) -->
          </ul>
          <ul>
            <li @click="CloseSubChild">
              <span> <i class="fa-solid fa-chevron-left" />{{ SubChildMenuTitle }} </span>
            </li>
            <li v-for="item in SubChildMenu" :key="item.id">
              <nuxt-link
                :to="
                  localePath({
                    path: defineLink(item),
                  })
                "
              >
                {{ item.title }}
              </nuxt-link>
            </li>
            <!-- defineLink(item) -->
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  data () {
    return {
      Menu: [],
      SubMenu: [],
      SubMenuTitle: [],
      SubChildMenu: [],
      SubChildMenuTitle: [],
      isActive: false,
      isActiveChild: false
    }
  },
  computed: {
    ...mapGetters(['getMenu'])
  },
  watch: {
    $route: {
      handler () {
        this.closeMobile()
      }
    }
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

    onClick (e) {
      if (e.target.classList[0] === 'mobile-menu') {
        this.$store.commit('auth/setNavbar', false)
      }
    },
    closeMobile () {
      this.$emit('closeMobile')
    },
    defineLink (item) {
      if (item.link) {
        return '/' + item.link
      } else if (item.slug) {
        return '/static/' + item.slug
      } else {
        return '/'
      }
    },
    OpenSub (item) {
      if (item && item.submenu && item.submenu.length) {
        this.SubMenu = item.submenu
        this.SubMenuTitle = item.title
      }
      setTimeout(() => {
        this.isActive = true
      }, 100)
    },
    CloseSub () {
      this.isActive = false
    },

    OpenSubChild (item) {
      if (item && item.submenu && item.submenu.length) {
        this.SubChildMenu = item.submenu
        this.SubChildMenuTitle = item.title
      }
      setTimeout(() => {
        this.isActiveChild = true
      }, 100)
    },
    CloseSubChild () {
      this.isActiveChild = false
    }
  }

}
</script>

  <style>
  .mobile {
    position: relative;
    z-index: 2;
    width: 0;
    height: 0;
  }

  .mobile-menu {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.4);
    transition: all 0.2s ease-in-out;
  }

  .mobile-menu-active .mobile-menu {
    display: block !important;
    transition: all 0.2s ease-in-out;
  }
  .mobile-menu-wrapper {
    max-width: 410px;
    width: 100%;
    height: 100vh;
    background: linear-gradient(180deg, #ed7004 0%, #ff9942 100%);
    position: fixed;
    padding: 100px 0px 60px 20px;
    top: 0;
    transform: translateX(-100%);
    transition: all 0.2s ease-in-out;
  }
  .mobile-menu-active .mobile-menu-wrapper {
    transform: translateX(0%) !important;
    transition: all 0.2s ease-in-out;
  }
  .mobile-menu-wrapper > i {
    color: white;
    position: absolute;
    top: 20px;
    right: 20px;
    cursor: pointer;
    /* transform: rotate(45deg); */
  }
  .mobile-menu-list {
    position: relative;
  }
  .mobile-menu-list h3 {
    position: absolute;
    height: 38px;
    top: 0;
    left: 0;
    right: 20px;
    transform: translateY(-100%);
    margin-bottom: 0;
    font-weight: 600;
    font-size: 18px;
    color: #ffffff;
    text-align: center;
    line-height: 38px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  }
  .mobile-menu-list-wrapper {
    height: calc(100vh - 160px);
    padding-right: 20px;
    overflow-y: scroll;
    position: relative;
    overflow-x: hidden;
  }
  .mobile-menu-list-wrapper::-webkit-scrollbar-track {
    background: linear-gradient(180deg, #ed7004 0%, #ff9942 100%);
    border-radius: 4px;
  }

  .mobile-menu-list-wrapper::-webkit-scrollbar {
    width: 4px;
    background-color: #529dd6;
  }

  .mobile-menu-list-wrapper::-webkit-scrollbar-thumb {
    border-radius: 10px;
    /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); */
    background: linear-gradient(180deg, #773c07 0%, #c07330 100%);
    border-radius: 4px;
  }

  .mobile-menu-list-wrapper ul {
    transition: all 0.3s ease-in-out;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 20px;
    list-style: none;
    margin-bottom: 0;
  }
  .mobile-menu-list-wrapper ul li {
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  }
  /* .mobile-menu-list-wrapper ul:first-child {
  } */

  .mobile-menu-list-wrapper ul:nth-child(2) {
    transform: translateX(calc(100% + 20px));
  }
  .mobile-menu-list-wrapper ul:nth-child(3) {
    transform: translateX(calc(100% + 20px));
  }
  .mobile-menu-list-wrapper.active ul:first-child {
    transform: translateX(-100%);
  }
  .mobile-menu-list-wrapper.active ul:nth-child(2) {
    transform: translateX(0);
  }
  .mobile-menu-list-wrapper.activeSub ul:nth-child(2) {
    transform: translateX(-100%);
  }

  .mobile-menu-list-wrapper.activeSub ul:nth-child(3) {
    transform: translateX(0);
  }
  .mobile-menu-list-wrapper.active ul:last-child li:first-child span {
    text-align: center;
    margin: 0 0 10px 0;
    justify-content: center;
    position: relative;
    color: #9db7dc;
  }
  .mobile-menu-list-wrapper.active ul:nth-child(2) li:first-child span i {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
  }
  .mobile-menu-list-wrapper.active ul:nth-child(2) li:first-child span {
    text-align: center;
    justify-content: center;
    position: relative;
    color: #fff;
  }
  .mobile-menu-list-wrapper.active ul:last-child li:first-child span i {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
  }
  .mobile-menu-wrapper ul li a,
  .mobile-menu-wrapper ul li span {
    font-weight: 500;
    font-size: 16px;
    line-height: 22px;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 0;
  }
  .mobile-menu-list-wrapper > ul > li > span > i {
    /* transform: rotate(45deg); */
    font-size: 12px;
    padding: 4px;
  }
  .mobile-menu-wrapper .header-lang {
    position: absolute;
    left: 20px;
    top: 20px;
  }
  .mobile-menu-wrapper .header-lang button {
    font-size: 19px;
  }
  .mobile-menu-wrapper .header-lang {
    display: none;
  }
  .mobile-menu-wrapper .header-lang .header-lang-options {
    right: -4px;
    top: calc(100% - -2px);
    padding: 5px 9px;
  }
  .header.pages-header .menuMobile {
    color: #212721;
  }
  @media (max-width: 768px) {
    .mobile-menu {
      padding-top: 145px;
    }
  }
  @media (max-width: 575px) {
    .mobile-menu {
      padding-top: 176px;
    }
    .mobile-menu-wrapper ul li a,
    .mobile-menu-wrapper ul li span {
      font-size: 14px;
      line-height: 20px;
    }
    .mobile-menu-wrapper .header-lang {
      display: block !important;
    }
  }
  @media (max-width: 450px) {
    .mobile-menu {
      padding-top: 173px;
    }
  }
  @media (max-width: 337px) {
    .mobile-menu {
      padding-top: 180px;
    }
  }
  </style>
