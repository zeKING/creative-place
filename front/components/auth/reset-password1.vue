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
      <div class="modal-content modal-content-search">
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
              <label for="code">{{ $t("Phone number") }}</label>
              <input
                id="code"
                v-model="form.phone"
                v-mask="'+998#########'"
                type="tel"
                name="phone"
                placeholder="+998"
                :class="{
                  invalid: $v.form.phone.$dirty && !$v.form.phone.required,
                }"
              />
              <div
                v-if="$v.form.phone.$dirty && !$v.form.phone.required"
                class="invalid"
              >
                {{ $t("Обязательное поле") }}
              </div>
              <button>{{ $t("Confirm") }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import { mapActions, mapMutations } from "vuex";
export default {
  data() {
    return {
      form: {
        phone: "",
      },
      expiresTime: 60,
      resendCode: false,
    };
  },
  validations: {
    form: {
      phone: {
        required,
      },
    },
  },
  computed: {},
  watch: {},
  mounted() {},
  methods: {
    ...mapActions("login", ["resetPassword"]),
    ...mapMutations("login", ["SET_USER_PHONE"]),
    async onSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.submitStatus = "ERROR";
      } else {
        this.submitStatus = "PENDING";
        try {
          const form = this.toFormData({ ...this.form });
          this.SET_USER_PHONE(this.form.phone);
          await this.resetPassword(form);
          this.$emit("openModal", "ResetPassword2Visible");
        } catch ({ message }) {
          this.$notify(message);
        }
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
