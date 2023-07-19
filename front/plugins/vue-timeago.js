import Vue from 'vue'
import VueTimeago from 'vue-timeago'

Vue.use(VueTimeago, {
  name: 'Timeago', // Component name, `Timeago` by default
  locale: 'ru', // Default locale
  // We use `date-fns` under the hood
  // So you can use all locales from it
  locales: {
    'ru-RU': require('date-fns/locale/ru'),
    ru: require('date-fns/locale/ru')
  }
})
