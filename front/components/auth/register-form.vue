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
            {{ $t('Registration') }}
          </h5>
          <button
            type="button"
            class="close"
            @click="$emit('close')"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body centerr">
          <form @submit.prevent="onSubmit">
            <div class="form_left">
              <label for="phone">{{ $t('Phone number') }}</label>
              <input
                id="phone"
                v-model="form.phone"
                v-mask="'+998#########'"
                type="tel"
                placeholder="+998"
                :class="{invalid: $v.form.phone.$dirty && !$v.form.phone.required}"
              >
              <div v-if="$v.form.phone.$dirty && !$v.form.phone.required" class="invalid">
                {{ $t('Required field') }}
              </div>
              <label for="password">{{ $t('Password') }}</label>
              <input
                id="password"
                v-model="form.password"
                type="password"
                :class="{invalid: $v.form.password.$dirty && !$v.form.password.required}"
              >
              <div v-if="$v.form.password.$dirty && !$v.form.password.required" class="invalid">
                {{ $t('Required field') }}
              </div>
              <div v-else-if="$v.form.password.$dirty && !$v.form.password.minLength" class="invalid">
                {{ $t('The minimum length of characters is 8') }}
              </div>
              <label for="confirmPassword">{{ $t('Repeat the password') }}</label>
              <input
                id="confirmPassword"
                v-model="form.confirmPassword"
                type="password"
                :class="{invalid: $v.form.confirmPassword.$dirty && !$v.form.confirmPassword.required}"
              >
              <div v-if="$v.form.confirmPassword.$dirty && !$v.form.confirmPassword.required" class="invalid">
                {{ $t('Required field') }}
              </div>
              <label for="role">{{ $t('Role') }}</label>
              <select id="role" v-model="form.user_type">
                <option value="buyer" selected>
                  {{ $t('Buyer') }}
                </option>
                <option value="seller">
                  {{ $t('Seller') }}
                </option>
              </select>
              <button>
                {{ $t('Registration') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength, sameAs } from 'vuelidate/lib/validators'
import { mapActions } from 'vuex'
export default {
  data () {
    return {
      form: {
        phone: null,
        password: null,
        confirmPassword: null,
        user_type: 'seller'
      }
    }
  },
  validations: {
    form: {
      phone: {
        required
      },
      password: {
        required,
        minLength: minLength(8)
      },
      confirmPassword: {
        required,
        sameAsPassword: sameAs('password')

      }
    }
  },
  methods: {
    ...mapActions('login', ['register']),
    async onSubmit () {
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.submitStatus = 'ERROR'
      } else {
        this.submitStatus = 'PENDING'
        try {
          const form = { ...this.form }
          delete form.confirmPassword
          const data = await this.register(form)
          // eslint-disable-next-line camelcase
          const { data: { user_id } } = data

          this.$store.commit('login/SET_USER_ID', user_id)
          this.$store.commit('login/SET_USER_PHONE', this.form.phone)
          this.$store.commit('login/SET_USER_PASSWORD', this.form.password)
          localStorage.setItem('userId', user_id)
          localStorage.setItem('userPhone', this.form.phone)
          this.$emit('close')
          this.$emit('openModal', 'ConfirmCodeVisible')
        } catch ({ message }) {
          this.$notify(message)
        }
      }
    }
  }
}

</script>
