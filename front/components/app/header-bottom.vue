<template>
  <div v-if="isLoad" class="header_top">
    <div class="container">
      <div class="header_top_block">
        <div class="location" style="min-width: 60px">
          <p>
            {{ $t("Our talents") }} <br>
            - {{ $t("our salvation!") }}
          </p>
          <b-dropdown
            id="dropdown-1"
            v-model="dropdownValue"
            class="locations"
            style="min-width: 60px"
          >
            <template #button-content>
              <svgicon name="location" color="#000" :fill="false" />
              <span> Узбекистан</span>
            </template>
            <b-dropdown-item
              v-for="(item, i) of sites"
              :key="i"
              :active="item.active"
              :href="item.url"
              target="_blank"
            >
              {{ item.title }}
            </b-dropdown-item>
          </b-dropdown>
        </div>
        <nuxt-link class="logo_img" to="/">
          <img src="../../assets/images/main-logo.png" alt="logo">
        </nuxt-link>
        <div class="icons_right">
          <div class="language_dropdown">
            <img src="../../assets/svg/lang.svg" alt="language">
            <b-form-select v-model="selected">
              <b-form-select-option
                v-for="(item, index) of options"
                :key="index"
                :value="item.value"
              >
                {{ item.text }}
              </b-form-select-option>
            </b-form-select>
          </div>

          <div class="icons_right_icon">
            <svgicon
              v-if="$route.path != '/'"
              icon="search"
              color="#000"
              class="search"
              :fill="false"
              @click="openModal('SearchVisible')"
            />
            <!-- Modal -->
            <div class="icon-wrapper">
              <span v-if="$auth.user && $auth.user.isNewNotification" />
              <svgicon
                icon="notification"
                color="#000"
                class="notification"
                :fill="false"
                @click="openModal('NotificationVisible')"
              />
            </div>
            <!-- modal  -->

            <svgicon
              icon="message"
              color="#000"
              class="message"
              :fill="false"
              @click="openModal('chatVisible')"
            />
            <!-- Modal chats-->
            <div class="icon-wrapper">
              <span v-if="$auth.user && $auth.user.isNewCart" />
              <svgicon
                icon="cart"
                color="#000"
                class="cart"
                :fill="false"
                @click="openModal('cartVisible')"
              />
            </div>
            <!-- Modal 2-->
            <div class="icon-wrapper">
              <span v-if="$auth.user && $auth.user.isNewFavorite" />

              <svgicon
                icon="star"
                color="#000"
                class="star"
                :fill="false"
                @click="openModal('FavoriteVisible')"
              />
            </div>
          </div>
          <div class="icons_right_img">
            <img
              :src="getImage"
              alt=""
              :class="{ 'rounded-0': !$auth.user?.photo }"
            >

            <i class="fa-solid fa-angle-down" />
            <div v-if="!isLoggedIn" class="hov">
              <a
                href="javascript:void(0)"
                @click.prevent="openModal('LoginFormVisible')"
              >{{ $t("Entrance") }}</a>
              <a
                href="javascript:void(0)"
                @click.prevent="openModal('RegisterFormVisible')"
              >{{ $t("Registration") }}</a>
            </div>
            <div v-else class="hov">
              <!-- <span /> -->
              <a
                href="javascript:void(0)"
                @click.prevent="$router.push('/profile')"
              >{{ $t("profile") }}</a>
              <a href="javascript:void(0)" @click.prevent="logOut">Выйти</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <AppUiModalCart
      v-if="modals.cartVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AppUiModalChat
      v-if="modals.chatVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AppUiModalFavorite
      v-if="modals.FavoriteVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AppUiModalInfoCard
      v-if="modals.InfoCardVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AppUiModalNotification
      v-if="modals.NotificationVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AppUiModalPayResult
      v-if="modals.PayResultVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AppUiModalPay
      v-if="modals.PayVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AppUiModalSearch
      v-if="modals.SearchVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AuthRegisterForm
      v-if="modals.RegisterFormVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AuthRegisterForm2
      v-if="modals.RegisterForm2Visible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AuthLoginForm
      v-if="getAuthFormVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AuthConfirmCode
      v-if="modals.ConfirmCodeVisible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AuthResetPassword1
      v-if="modals.ResetPassword1Visible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AuthResetPassword2
      v-if="modals.ResetPassword2Visible"
      @close="closeModals"
      @openModal="openModal"
    />
    <AuthResetPassword3
      v-if="modals.ResetPassword3Visible"
      @close="closeModals"
      @openModal="openModal"
    />
  </div>
</template>

<script>
import { mapActions, mapMutations, mapState, mapGetters } from 'vuex'
import '~/components/svg-icons/cart'
import '~/components/svg-icons/location'
import '~/components/svg-icons/message'
import '~/components/svg-icons/notification'
import '~/components/svg-icons/search'
import '~/components/svg-icons/star'

export default {
  data () {
    return {
      selected: this.$i18n.locale,
      options: [
        { value: 'uz', text: 'Uzbek' },
        { value: 'ru', text: 'Русский' },
        { value: 'en', text: 'English' }
      ],
      sites: [],
      modals: {
        cartVisible: false,
        chatVisible: false,
        FavoriteVisible: false,
        InfoCardVisible: false,
        NotificationVisible: false,
        PayResultVisible: false,
        PayVisible: false,
        SearchVisible: false,
        RegisterFormVisible: false,
        LoginFormVisible: false,
        RegisterForm2Visible: false,
        ConfirmCodeVisible: false,
        ResetPassword1Visible: false,
        ResetPassword2Visible: false,
        ResetPassword3Visible: false
      },
      dropdownList: [
        { title: 'Узбекистан', active: true },
        { title: 'Россия' },
        { title: 'Чехия' }
      ],
      dropdownValue: 'Uzbek',
      isLoad: false
    }
  },
  computed: {
    ...mapState('login', ['isLoggedIn']),
    ...mapGetters(['getAuthFormVisible']),
    getImage () {
      if (this.isLoggedIn) {
        return this.$auth.user.photo
          ? this.$auth.user.photo
          : require('../../assets/images/avatar.svg')
      } else {
        return require('../../assets/images/avatar.svg')
      }
    }
  },
  watch: {
    dropdownValue (value) {
      console.log(value)
    },
    selected (value) {
      this.$i18n.setLocale(value)
      this.$i18n.setLocaleCookie(value)
      this.$router.go()
    }
  },
  async mounted () {
    // this.selected = this.$i18n.locale
    await this.getSites()
    setTimeout(() => {
      this.isLoad = true
    }, 0)
  },

  methods: {
    ...mapActions(['getOtherSites']),
    ...mapMutations(['closeAuthForm', 'openAuthForm']),
    closeModals () {
      this.modals = {
        cartVisible: false,
        chatVisible: false,
        FavoriteVisible: false,
        InfoCardVisible: false,
        NotificationVisible: false,
        PayResultVisible: false,
        PayVisible: false,
        SearchVisible: false,
        RegisterFormVisible: false,
        LoginFormVisible: false,
        RegisterForm2Visible: false,
        ConfirmCodeVisible: false,
        ResetPassword1Visible: false,
        ResetPassword2Visible: false,
        ResetPassword3Visible: false
      }
      this.closeAuthForm()
    },
    openModal (modal) {
      this.closeModals()
      if (modal === 'chatVisible' && !this.isLoggedIn) {
        this.openModal('LoginFormVisible')
        return ''
      }
      if (modal === 'LoginFormVisible') {
        this.openAuthForm()
      }
      this.modals[modal] = true
    },

    async logOut () {
      this.$store.commit('login/AUTH_ERROR')
      localStorage.removeItem('auth._token.local')
      await this.$cookies.removeAll()
      this.$router.push('/')
      await this.$auth.setUser(null)
    },
    async getSites () {
      try {
        this.sites = await this.getOtherSites()
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    switchLocale2 (value) {
      console.log(value, 'value')
      this.$i18n.setLocale(value)
      console.log(this.$i18n.locale, '$i18n')
    }

  }
}
</script>

<style>
.icon-wrapper {
  position: relative;
  cursor: pointer;
}
.icon-wrapper > span {
  position: absolute;
  right: 0;
  top: 0;
  width: 10px;
  height: 10px;
  background-color: red;
  border-radius: 50%;
}
</style>
