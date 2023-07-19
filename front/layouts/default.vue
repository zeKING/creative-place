<template>
  <div>
    <header class="header">
      <appHeaderTop v-if="$route.fullPath == '/'" />
      <appHeaderBottom />
      <appHeaderNav />
    </header>

    <main class="main">
      <div v-if="loader">
        <transition name="fade" mode="in-out" />
      </div>
      <Nuxt />
    </main>
    <appFooter />
    <notifications />
  </div>
</template>

<script>

export default {
  data () {
    return {
      loader: true
    }
  },
  mounted () {
    if (this.$cookies.get('auth._token.local')) {
      this.$store.commit('login/AUTH_SUCCESS')
    }
  }
}
</script>
