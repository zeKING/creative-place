<template>
  <div class="carusel_home">
    <div class="container">
      <div class="Edit_profile">
        <img :src="form.photo || require('~/assets/images/avatar.svg')" alt="" :class="{'rounded-0' : !form.photo}">
        <div class="Edit_profile_name">
          <h4>{{ form.name }}</h4>
        </div>
        <span>{{ form.age }} лет</span>
        <div class="Edit_profile_border">
          <div class="Edit_profile_border_block">
            <h4>{{ form.count_work }} <span>раз</span></h4>
            <p>Продукты</p>
          </div>
          <div class="Edit_profile_border_block">
            <h4>{{ form.sel }} <span>раз</span></h4>
            <p>Продано</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    form: {
      type: Object,
      required: true
    }
  },
  data () {
    return {

    }
  },
  mounted () {

  }
}
</script>
