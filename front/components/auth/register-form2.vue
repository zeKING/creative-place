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
              <label for="ish">{{ $t("Name and surname") }}</label>
              <input
                id="ish"
                v-model="form.name"
                type="text"
                :placeholder="$t('Name and surname')"
                :class="{
                  invalid: $v.form.name.$dirty && !$v.form.name.required,
                }"
              />
              <div
                v-if="$v.form.name.$dirty && !$v.form.name.required"
                class="invalid"
              >
                {{ $t("Required field") }}
              </div>

              <label for="cars">{{ $t("Birthday") }}</label>
              <input
                v-model="form.birthday"
                type="date"
                :placeholder="`${$t('For example')}: 18.07.1999`"
                :class="{
                  invalid:
                    $v.form.birthday.$dirty && !$v.form.birthday.required,
                }"
              />

              <div
                v-if="$v.form.birthday.$dirty && !$v.form.birthday.required"
                class="invalid"
              >
                {{ $t("Required field") }}
              </div>

              <label for="som">{{ $t("Information about yourself") }}</label>
              <textarea v-model="form.about_me" />

              <label for="som">{{ $t("Photo") }}</label>
              <b-form-file
                v-model="form.photo"
                placeholder="Choose a file or drop it here..."
                drop-placeholder="Drop file here..."
              />
              <div v-if="fileError" class="mt-2 invalid">
                {{ fileError }}
              </div>
              <button>
                {{ $t("Save") }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { required } from "vuelidate/lib/validators";
export default {
  data() {
    return {
      form: {
        name: "",
        photo: null,
        about_me: "",
        birthday: "",
      },
      fileError: "",
    };
  },
  validations: {
    form: {
      name: {
        required,
      },
      birthday: {
        required,
      },
    },
  },
  computed: {
    ...mapGetters("login", ["getUserId", "getUserPhone"]),
  },
  watch: {
    "form.photo"(val) {
      this.fileError = "";
      if (val.type !== "image/jpeg") {
        this.fileError = "Можно загружать только файлы типа jpeg";
      }
      if (val.size > 1024 * 1024 * 5) {
        this.fileError = "Размер файла не должен превышать 5mb";
      }
    },
  },
  mounted() {
    if (!this.getUserPhone) {
      const phone = localStorage.getItem("userPhone");
      this.$store.commit("login/SET_USER_PHONE", phone);
    }
  },

  methods: {
    ...mapActions("login", ["setUserData"]),
    async onSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.submitStatus = "ERROR";
      } else {
        if (this.fileError) {
          return "";
        }
        try {
          const form = {
            ...this.form,
            user_id: this.getUserId,
            phone: this.getUserPhone,
          };
          await this.setUserData(form);

          this.$emit("close");
        } catch ({ message }) {
          this.$notify(message);
        }
      }
    },
  },
};
</script>
