export default function ({ $axios, i18n }) {
  // const token = $cookies.get('access_token')
  // console.log($auth)
  $axios.setHeader('lang', i18n.locale || 'oz')
  if (process.server) {
    $axios.onRequest((config) => {
      // if (!config.headers.common.Authorization && token !== null) { //  If request don't have auth header, set it with token from variable
      //   config.headers.common.Authorization = `Bearer ${token}`
      // }

      return config
    })
  } else {
    $axios.onRequest((config) => {
      // if (!config.headers.common.Authorization && token !== null) { //  If request don't have auth header, set it with token from variable
      //   config.headers.common.Authorization = `Bearer ${token}`
      // }

      return config
    })
  }
}
