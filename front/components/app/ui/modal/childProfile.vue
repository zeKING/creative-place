<template>
  <div
    id="staticBackdro"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="staticBackdropLabel" class="modal-title">
            {{ $t("Change Profile") }}
          </h5>
          <button type="button" class="close" @click="$emit('close')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body centerr">
          <form @submit.prevent="userEdit">
            <div class="form_left">
              <label for="ish">{{ $t("Name and surname") }}</label>
              <input
                id="ish"
                v-model="form.name"
                type="text"
                :placeholder="`${$t('For example')}: Рустамжон Абдуллаев`"
              >

              <label for="cars">{{ $t("Birthday") }}</label>
              <input
                v-model="form.birthday"
                type="date"
                :placeholder="`${$t('For example')}: 18.07.1999`"
              >
              <label for="som">{{ $t("Email") }}</label>
              <input
                id="som"
                v-model="form.email"
                type="text"
                :placeholder="`${$t('For example')}: naprimer@mail.ru`"
              >
              <div
                class="change-phone-text"
                @click="$emit('open', 'changePhone')"
              >
                {{ $t("Change Phone number") }}
              </div>
              <div
                class="change-phone-text mt-2"
                @click="$emit('open', 'changePassword')"
              >
                {{ $t("Change Password") }}
              </div>

              <button>
                {{ $t("Submit") }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      form: {
        name: '',
        email: '',
        birthday: '',
        user_id: ''
      },
      phones: [],
      selectPhone: ''
    }
  },
  async mounted () {
    this.form.name = this.$auth.user.name
    this.form.birthday = this.$auth.user.birthday
    this.form.email = this.$auth.user.email
    this.form.user_id = this.$auth.user.user_id
    await this.getPhones()
  },
  methods: {
    ...mapActions('profile', ['userUpdate']),
    ...mapActions('form', ['fetchPhones']),
    async userEdit () {
      try {
        const form = this.toFormData(this.form)
        await this.userUpdate(form)
        this.$emit('close')
        await this.$auth.fetchUser()
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    async getPhones () {
      try {
        this.phones = await this.fetchPhones()
        this.selectPhone = this.phones[0].code
        if (!this.form.phone) {
          this.form.phone = this.selectPhone
        }
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    onSelect (item) {
      this.selectPhone = item.code
      this.form.phone = this.selectPhone
    }
  }
}
</script>

<style>
.icon {
  width: 31px;
  height: 18px;
}
.dropdown {
  width: 66px;
  height: 56px;
}
.sweet-action-close:hover {
  background: linear-gradient(180deg, #ed7004 0%, #ff9942 100%) !important;
}
.telefon {
  display: flex;
}
.dropdown {
  height: 56px;
  margin-right: 16px;
}

.telefon input {
  display: block;
  background: #ffffff;
  border-radius: 8px;
  width: 100%;
  height: 56px;
  border: 0;
  margin-bottom: 16px;
}
.change-phone-text {
  color: #f07810;
  cursor: pointer;
}
</style>
