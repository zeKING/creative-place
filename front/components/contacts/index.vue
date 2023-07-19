<template>
  <section v-if="data" class="home-contacts">
    <div class="container">
      <div class="title-allblock">
        <h2 class="title text-dark">
          {{ $t('Contacts') }}
        </h2>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="contacts-left">
            <div class="row">
              <div class="col-10">
                <div class="contacts-left__info">
                  <h1>{{ $t('Address') }}:</h1>
                  <span>{{ data.address }}</span>
                </div>
                <div class="contacts-left__info">
                  <h1>{{ Phone }}:</h1>
                  <a :href="`tel:${data.phone}`">{{
                    data.phone | formatPhone
                  }}</a>
                </div>
                <div class="contacts-left__info">
                  <h1>{{ $t('Email') }}:</h1>
                  <a :href="`mailto:${data.email}`">{{ data.email }}</a>
                </div>
                <div class="contacts-left__info mb-0">
                  <h1>{{ $t('Operating mode') }}:</h1>
                  <span>{{ data.vremya_raboti }}</span>
                </div>
              </div>
              <div class="col-2">
                <div class="contacts-left__social">
                  <a
                    v-for="(item, i) of getSocial"
                    :key="i"
                    :href="item.link"
                  ><i
                    class="fa-brands"
                    :class="`fa-${item.title}`"
                    aria-hidden="true"
                  /></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="contacts-right" v-html="data.map" />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  data () {
    return {
      data: null
    }
  },
  computed: {
    ...mapGetters(['getSocial'])
  },
  async mounted () {
    if (!this.getSocial) {
      this.fetchLinks()
    }
    console.log(this.getSocial, 'sss')
    try {
      const [data] = await this.fetchData()
      this.data = data
    } catch ({ message }) {
      this.$notify(message)
    }
  },
  methods: {
    ...mapActions('contacts', ['fetchData']),
    ...mapActions(['fetchSocial']),
    async fetchLinks () {
      try {
        await this.fetchSocial()
      } catch ({ message }) {
        this.$notify(message)
      }
    }
  }
}
</script>

<style >
/*home-contacts*/
.title-allblock {
  margin: 0 0 30px 0;
}
.contacts-left {
  width: 100%;
  background: #fbfbfb;
  border-radius: 3px;
  overflow: hidden;
  padding: 45px 40px;
  border-radius: 20px;
}

.contacts-left__info {
  margin-bottom: 40px;
}

.contacts-left__info h1 {
  font-family: "Montserrat", sans-serif;
  font-style: normal;
  font-weight: 600;
  font-size: 18px;
  line-height: 25px;
  color: #615f5f;
}

.contacts-left__info span {
  font-size: 16px;
  line-height: 22px;
  color: #1d1b1b;
}

.contacts-left__info a {
  font-size: 16px;
  line-height: 22px;
  color: #1d1b1b;
}

.contacts-left__social {
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 100%;
}

.contacts-left__social a {
  display: block;
  margin-top: 35px;
  text-align: center;
}

.contacts-left__social a i {
  font-size: 23px;
  color: #fb6e01;
}

.contacts-right {
  width: 100%;
  height: 100%;
}

.contacts-right iframe {
  width: 100%;
  height: 100%;
  border-radius: 20px;
}

.container {
  max-width: 1392px;
}
/*end of home-contacts*/
</style>
