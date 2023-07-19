export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'dar',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/img/logo_img.png' },
      { rel: 'stylesheet', href: 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css' },
      { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap' }
    ]
  },
  publicRuntimeConfig: {
    recaptcha: {
      version: 2,
      /* reCAPTCHA options */
      siteKey: process.env.RECAPTCHA_SITE_KEY // for example
    }
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    './assets/fonts/Gilroy/stylesheet.css',
    './assets/fonts/Nunito/stylesheet.css',
    '~/assets/css/main.css'

  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: '~/plugins/swiper.js', mode: 'client' },
    { src: '~/plugins/vmask.js' },
    {
      src: '~/plugins/Vuelidate.js'
    },
    { src: '~/plugins/vue-notification.js', mode: 'client' },
    { src: './plugins/helpers.js', mode: 'client' },
    { src: './plugins/axios.js' },
    { src: '~/plugins/vue-svgicon.js' },
    { src: './plugins/vue-select.js', mode: 'client' },
    { src: './plugins/vue-timeago.js', mode: 'client' },
    { src: './plugins/i18n.js' }

  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/eslint
    '@nuxtjs/eslint-module'
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/bootstrap
    'bootstrap-vue/nuxt',
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    '@nuxtjs/i18n',
    '@nuxtjs/recaptcha',
    'cookie-universal-nuxt',
    '@nuxtjs/dotenv'

  ],
  auth: {
    plugins: [{ src: '~/plugins/axios', ssr: true }],
    strategies: {
      local: {
        token: {
          property: 'data.access_token',
          global: true,
          type: 'Bearer'
        },
        user: {
          autoFetch: true,
          property: 'data'
        },
        endpoints: {
          login: { url: 'api/user/login', method: 'post' },
          logout: { url: 'api/user/logout', method: 'post' },
          user: { url: 'api/auth/user', method: 'get' }
        }

      }
    }
  },
  i18n: {
    langDir: '~/locales/',
    locales: [
      { code: 'en', iso: 'en-US', file: 'en.js', name: 'English' },
      { code: 'ru', iso: 'ru-RU', file: 'ru.js', name: 'Russian' },
      { code: 'uz', iso: 'uz-UZ', file: 'uz.js', name: 'Uzbek' }
    ],
    // lazy: true,
    defaultLocale: 'uz',
    // strategy: 'prefix_except_default',
    strategy: 'no_prefix',
    vueI18nLoader: true,
    detectBrowserLanguage: {
      useCookie: true,
      cookieKey: 'lang'
    },
    vueI18n: {
      silentTranslationWarn: true,
      silentFallbackWarn: true
    }
  },
  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
    baseURL: process.env.BASE_URL,
    proxy: true,
    progress: false
  },
  proxy: {
    '/api': {
      xfwd: true,
      target: process.env.BASE_URL
      // pathRewrite: {
      //   '^/api': ''
      // }
    },
    '/chat': {
      xfwd: true,
      target: process.env.CHAT_URL,
      pathRewrite: {
        '^/chat': '/api'
      }
    }
  },
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
