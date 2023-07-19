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
            {{ $t("Change Phone number") }}
          </h5>
          <button type="button" class="close" @click="$emit('close')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body centerr">
          <form @submit.prevent="onSubmit">
            <div class="form_left">
              <div class="form_left-cancel-button">
                <i class="fa-sharp fa-solid fa-arrow-left" @click="$emit('open', 'childProfileVisible')" />
              </div>
              <label for="code">{{ $t("Phone") }} </label>
              <div class="telefon">
                <div class="dropdown">
                  <AppUiDropdown2
                    v-if="phones && phones.length"
                    :list="phones"
                    :default-selected="phones[0]"
                    @select="onSelect"
                  />
                </div>
                <input
                  id="phone1"
                  v-model="form.phone"
                  v-mask="`X############`"
                  type="tel"
                  :placeholder="selectPhone"
                >
              </div>
              <div
                v-if="$v.form.phone.$dirty && !$v.form.phone.required"
                class="invalid"
              >
                {{ $t("Required field'") }}
              </div>
              <button>{{ $t("Submit") }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required } from 'vuelidate/lib/validators'
import { mapActions, mapGetters, mapMutations } from 'vuex'
export default {
  data () {
    return {
      form: {
        phone: ''
      },
      resendCode: false,
      phones: [],
      selectPhone: ''
    }
  },
  validations: {
    form: {
      phone: {
        required
      }
    }
  },
  computed: {
    ...mapGetters('login', ['getUserId'])
  },

  async mounted () {
    await this.getPhones()
  },
  methods: {
    // ...mapActions('login', ['confirmCode', 'fetchSms']),
    ...mapActions('form', ['fetchPhones']),
    ...mapActions('profile', ['changePhone']),
    ...mapMutations('profile', ['SET_USER_PHONE']),
    async onSubmit () {
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.submitStatus = 'ERROR'
      } else {
        this.submitStatus = 'PENDING'
        try {
          const form = this.toFormData({
            ...this.form
          })
          await this.changePhone(form)
          this.SET_USER_PHONE(this.form.phone)
          this.$emit('open', 'confirmPasswordPhone')
        } catch ({ message }) {
          this.$notify(message)
        }
      }
    },
    onSelect (item) {
      this.selectPhone = item.code
      this.form.phone = this.selectPhone
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
    }
  }
}
</script>

<style>
.not-receive {
  display: flex;
  justify-content: flex-end;
  margin-top: 16px;
  cursor: pointer;
}
.disabled {
  color: #6c757d !important;
  cursor: not-allowed;
}
</style>
