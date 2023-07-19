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
            {{ $t("Restoring access") }}
          </h5>
          <button type="button" class="close" @click="$emit('close')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body centerr">
          <form @submit.prevent="onSubmit">
            <div class="form_left">
              <label for="password">{{ $t("Password") }}</label>
              <input
                id="password"
                v-model="form.password"
                name="password"
                type="password"
                :class="{
                  invalid:
                    $v.form.password.$dirty && !$v.form.password.required,
                }"
              />
              <div
                v-if="$v.form.password.$dirty && !$v.form.password.required"
                class="invalid"
              >
                {{ $t("This field is required") }}
              </div>
              <div
                v-if="$v.form.password.$dirty && !$v.form.password.minLength"
                class="invalid"
              >
                {{ $t("The password must consist of at least 8 characters") }}
              </div>

              <label for="confirmPassword">{{
                $t("Repeat the password")
              }}</label>
              <input
                id="confirmPassword"
                v-model="form.confirmPassword"
                type="password"
                name="password"
                :class="{
                  invalid:
                    ($v.form.confirmPassword.$dirty &&
                      !$v.form.confirmPassword.required) ||
                    ($v.form.confirmPassword.$dirty &&
                      !$v.form.confirmPassword.sameAsPassword),
                }"
              />
              <div
                v-if="
                  $v.form.confirmPassword.$dirty &&
                  !$v.form.confirmPassword.required
                "
                class="invalid"
              >
                {{ $t("This field is required") }}
              </div>
              <div
                v-else-if="
                  $v.form.confirmPassword.$dirty &&
                  !$v.form.confirmPassword.sameAsPassword
                "
                class="invalid"
              >
                {{ $t("Passwords don't match") }}
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
import { required, minLength, sameAs } from "vuelidate/lib/validators";
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      form: {
        password: null,
        confirmPassword: null,
      },
    };
  },
  validations: {
    form: {
      password: {
        required,
        minLength: minLength(8),
      },
      confirmPassword: {
        required,
        sameAsPassword: sameAs("password"),
      },
    },
  },
  computed: {
    ...mapGetters("login", ["getUserId", "getUserPhone"]),
  },
  methods: {
    ...mapActions("login", ["register", "changePassword"]),
    async onSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.submitStatus = "ERROR";
      } else {
        // do your submit logic here
        this.submitStatus = "PENDING";
        try {
          const form = this.toFormData({
            password: this.form.password,
            user_id: this.getUserId,
            phone: this.getUserPhone,
          });
          await this.changePassword(form);
          this.$emit("close");
        } catch ({ message }) {
          this.$notify(message);
        }
      }
    },
    resetPassword() {
      this.$emit("openModal", "ResetPassword1Visible");
    },
  },
};
</script>
