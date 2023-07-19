<template>
  <section class="children section-space">
    <div class="container">
      <div class="children-text">
        <h2>Наши дети</h2>
        <p>
          Дети стараются сделать все что в их силах, дабы принести пользу
          обществу.
        </p>
      </div>
      <div class="children-wrapper">
        <div v-for="(item, index) of children" :key="index" class="children-card" @click="$router.push('/children/' + item.user_id)">
          <div class="children-img">
            <img :src="item.photo || require('~/assets/images/avatar.svg')" :class="{'rounded-0': !item.photo}" alt="Николаевна Анна">
          </div>
          <div class="card-data">
            <h4>{{ item.name }}</h4>
            <p class="children-old">
              {{ item.age }} лет
            </p>
            <p>
              {{ item.about_me }}
            </p>
          </div>
          <div class="children-card-footer">
            <p><i class="fa-solid fa-briefcase" /> {{ item.count_work }} работ</p>
            <button class="card-btn">
              Перейти <i class="fa-solid fa-right-long" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  data () {
    return {
      children: []
    }
  },
  async mounted () {
    try {
      this.children = await this.fetchChildren()
    } catch ({ message }) {
      this.$notify(message)
    }
  },
  methods: {
    // ...mapActions('home', ['fetchChildren']),
    ...mapActions('children', ['fetchChildren']),
    async fetData () {
      try {
        this.children = await this.fetchChildren()
      } catch ({ message }) {
        this.$notify(message)
      }
    }
  }

}
</script>

<style>
  .children-img {
    height: 112px;
  }
</style>
