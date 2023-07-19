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
      <div class="modal-content modal-registration">
        <div class="modal-header">
          <h5 id="staticBackdropLabel" class="modal-title">
            {{ $t('Entrance') }}
          </h5>
          <button
            type="button"
            class="close"
            @click="$emit('close')"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body centerr ">
          <form @submit.prevent="onSubmit">
            <div class="form_left">
              <label for="phone">{{ $t('Phone number') }}</label>
              <input
                id="phone"
                v-model="form.phone"
                v-mask="'+998#########'"
                name="phone"
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
                name="password"
                type="password"
                :class="{invalid: $v.form.password.$dirty && !$v.form.password.required}"
              >
              <div v-if="$v.form.password.$dirty && !$v.form.password.required" class="invalid">
                {{ $t('Required field') }}
              </div>
              <div v-else-if="$v.form.password.$dirty && !$v.form.password.minLength" class="invalid">
                {{ $t('The minimum length of characters is 8') }}
              </div>
              <div v-if="error" class="invalid">
                {{ text }}
              </div>
              <button>
                {{ $t('Entrance') }}
              </button>
              <div class="not-receive">
                <a href="#" @click.prevent="resetPassword">{{ $t('Forgot your password?') }}</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength } from 'vuelidate/lib/validators'
import { mapActions } from 'vuex'
export default {
  data () {
    return {
      form: {
        phone: null,
        password: null

      },
      error: false,
      text: 'Неправильный пароль или логин'
    }
  },
  validations: {
    form: {
      phone: {
        required
      },
      password: {
        required,
        minLength: minLength(6)
      }
    }
  },
  watch: {
    'form.password' (val) {
      this.error = false
    }
  },
  mounted () {
    this.$auth.options.redirect = false
  },
  methods: {
    ...mapActions('login', ['register']),
    async onSubmit () {
      this.error = false
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.submitStatus = 'ERROR'
      } else {
        // do your submit logic here
        this.submitStatus = 'PENDING'
        try {
          const form = this.toFormData(this.form)
          await this.$auth.loginWith('local', {
            data: form
          })
          this.$store.commit('login/AUTH_SUCCESS')
          this.$emit('close')
        } catch (error) {
          this.error = true
        }
      }
    },

    resetPassword () {
      this.$emit('openModal', 'ResetPassword1Visible')
    }
  }
}

</script>

<style>
  .modal-registration {
    min-height: 600px !important;
  }
</style>
