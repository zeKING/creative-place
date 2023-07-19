<template>
  <div>
    <div class="carusel_home home">
      <div class="container">
        <div class="Edit_profile">
          <img
            :src="form.photo || require('~/assets/images/avatar.svg')"
            :alt="form.name"
          >
          <div class="Edit_profile_name">
            <h4>{{ form.name }}</h4>
            <span @click="openModal('childProfileVisible')">
              <img src="img/pen.png" alt="pen">
            </span>

            <!-- Modal 2-->
          </div>
          <span>{{ form.age }} {{ $t("years") }}</span>
          <div class="Edit_profile_border">
            <div class="Edit_profile_border_block">
              <h4>{{ form.count_work }}</h4>
              <p>{{ $t("Products") }}</p>
            </div>
            <div class="Edit_profile_border_block">
              <h4>
                {{ form.sel }} <span>{{ $t("times") }}</span>
              </h4>
              <p>{{ $t("Sold") }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <AppUiModalChildProfile
      v-if="modals.childProfileVisible"
      @close="closeModals"
      @open="openModal"
    />
    <AuthChangePhone
      v-if="modals.changePhone"
      @close="closeModals"
      @open="openModal"
    />
    <AuthConfirmPasswordPhone
      v-if="modals.confirmPasswordPhone"
      @close="closeModals"
      @open="openModal"
    />
    <AuthChangePassword
      v-if="modals.changePassword"
      @close="closeModals"
      @open="openModal"
    />
  </div>
</template>

<script>
export default {
  props: {
    form: {
      type: Object,
      required: true
    },
    fetchData: {
      type: Function,
      required: true
    }
  },
  data () {
    return {
      modals: {
        childProfileVisible: false,
        changePhone: false,
        confirmPasswordPhone: false,
        changePassword: false
      }
    }
  },
  methods: {
    async openModal (value) {
      await this.closeModals()
      this.modals[value] = true
    },
    async closeModals () {
      await this.fetchData()
      this.modals = {
        childProfileVisible: false,
        changePhone: false,
        confirmPasswordPhone: false,
        changePassword: false
      }
    }
  }
}
</script>
