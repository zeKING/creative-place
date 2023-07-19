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
              <label for="code">{{ $t("Confirmation code") }}</label>
              <input
                id="code"
                v-model="form.activation_code"
                type="text"
                :class="{
                  invalid:
                    ($v.form.activation_code.$dirty &&
                      !$v.form.activation_code.required) ||
                    ($v.form.activation_code.$dirty &&
                      !$v.form.activation_code.minLength),
                }"
              />
              <div
                v-if="
                  $v.form.activation_code.$dirty &&
                  !$v.form.activation_code.required
                "
                class="invalid"
              >
                {{ $t("Обязательное поле") }}
              </div>
              <div
                v-if="
                  $v.form.activation_code.$dirty &&
                  !$v.form.activation_code.minLength
                "
                class="invalid"
              >
                {{ $t("Код должен состоять минимум из 5 символов") }}
              </div>
              <div class="not-receive">
                <p class="text-right" @click.prevent="notReceive">
                  {{ $t("Код истечет через:") }}
                  <span class="text-primary">{{ expiresTime }}</span>
                </p>
              </div>
              <button>{{ $t("Confirm") }}</button>
              <div class="not-receive">
                <p class="text-right">
                  {{ $t("Didn't get the code?") }}
                  <span
                    class="text-primary"
                    :disable="!resendCode"
                    :class="{ disabled: !resendCode }"
                    @click.prevent="notReceive"
                    >{{ $t("Send again") }}</span
                  >
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required, minLength } from "vuelidate/lib/validators";
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      form: {
        activation_code: "",
      },
      expiresTime: 60,
      resendCode: false,
    };
  },
  validations: {
    form: {
      activation_code: {
        required,
        minLength: minLength(5),
      },
    },
  },
  computed: {
    ...mapGetters("login", ["getUserId"]),
  },
  watch: {
    expiresTime(val) {
      if (val === 0) {
        this.resendCode = true;
      }
    },
  },
  mounted() {
    this.expires();
    if (!this.getUserId) {
      this.$store.commit("login/SET_USER_ID", localStorage.getItem("userId"));
    }
  },
  methods: {
    ...mapActions("login", ["confirmCode", "fetchSms"]),
    async onSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.submitStatus = "ERROR";
      } else {
        this.submitStatus = "PENDING";
        try {
          const form = this.toFormData({
            ...this.form,
            user_id: this.getUserId,
          });
          await this.confirmCode(form);
          this.$emit("openModal", "ResetPassword3Visible");
        } catch ({ message }) {
          this.$notify(message);
        }
      }
    },
    notReceive() {
      try {
        const form = this.toFormData({ user_id: this.getUserId });
        this.fetchSms(form);
      } catch ({ message }) {
        this.$notify(message);
      }
    },
    expires() {
      setInterval(() => {
        if (this.expiresTime > 0) {
          this.expiresTime--;
        } else {
          // this.resendCode = true
        }
      }, 1000);
    },
  },
};
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
