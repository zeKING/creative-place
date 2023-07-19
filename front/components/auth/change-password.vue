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
            {{ $t("Registration") }}
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
              <label for="oldPassword">{{ $t("oldPassword") }}</label>
              <input
                id="oldPassword"
                v-model="form.oldPassword"
                type="password"
                :class="{
                  invalid:
                    $v.form.oldPassword.$dirty && !$v.form.oldPassword.required,
                }"
              >
              <div
                v-if="
                  $v.form.oldPassword.$dirty && !$v.form.oldPassword.required
                "
                class="invalid"
              >
                {{ $t("Required field") }}
              </div>
              <label for="password">{{ $t("Password") }}</label>
              <input
                id="password"
                v-model="form.password"
                type="password"
                :class="{
                  invalid:
                    $v.form.password.$dirty && !$v.form.password.required,
                }"
              >
              <div
                v-if="$v.form.password.$dirty && !$v.form.password.required"
                class="invalid"
              >
                {{ $t("Required field") }}
              </div>
              <div
                v-else-if="
                  $v.form.password.$dirty && !$v.form.password.minLength
                "
                class="invalid"
              >
                {{ $t("The minimum length of characters is 8") }}
              </div>
              <label for="confirmPassword">{{
                $t("Repeat the password")
              }}</label>
              <input
                id="confirmPassword"
                v-model="form.confirmPassword"
                type="password"
                :class="{
                  invalid:
                    $v.form.confirmPassword.$dirty &&
                    !$v.form.confirmPassword.required,
                }"
              >
              <div
                v-if="
                  $v.form.confirmPassword.$dirty &&
                    !$v.form.confirmPassword.required
                "
                class="invalid"
              >
                {{ $t("Required field") }}
              </div>
              <button>
                {{ $t("Confirm") }}
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
        oldPassword: null,
        password: null,
        confirmPassword: null
      }
    }
  },
  validations: {
    form: {
      oldPassword: {
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
    ...mapActions('profile', ['changePassword']),
    ...mapActions('login', ['register']),
    async onSubmit () {
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.submitStatus = 'ERROR'
      } else {
        this.submitStatus = 'PENDING'
        try {
          const form = this.toFormData({ ...this.form })
          await this.changePassword(form)
          this.$emit('close')
        } catch ({ message }) {
          this.$notify(message)
        }
      }
    }
  }
}
</script>
