<template>
  <footer class="footer section-space">
    <div class="container">
      <div class="footer-wrapper wrapper">
        <div class="footer-logo">
          <div>
            <img src="../../assets/images/main-logo.png" alt="dar-logo" />
            <p>
              {{ $t("Our talents") }} <br />
              - {{ $t("our salvation!") }}
            </p>
          </div>
          <p>
            © 2018-2022, Официальный сайт <br />
            “Дар”
          </p>
        </div>

        <div class="footer-nav">
          <h2>{{ $t("Basic") }}</h2>
          <ul>
            <li v-for="(item, index) of getFooterMenu" :key="index">
              <nuxt-link :to="item.link || item.slug">
                {{ item.title }}
              </nuxt-link>
            </li>
          </ul>
        </div>

        <div class="footer-contacts">
          <div>
            <h2>{{ $t("Contacts") }}</h2>
            <ul>
              <li>
                <a :href="`mailto:${getEmail}`" target="_blank"
                  ><i class="fa-solid fa-at footer-icons" />{{ getEmail }}</a
                >
              </li>
              <li v-if="getPhone">
                <a :href="`tel:${getPhone}`"
                  ><i class="fa-solid fa-phone footer-icons" />{{
                    getPhone | formatPhone
                  }}</a
                >
              </li>
            </ul>
          </div>
          <div>
            <h2>{{ $t("Social networks") }}</h2>
            <div class="social">
              <a
                v-for="(item, index) of getSocial"
                :key="index"
                :href="item.link"
                ><i
                  class="fa-brands footer-icons"
                  :class="{ ['fa-' + item.title]: true }"
              /></a>
            </div>
          </div>
        </div>

        <div class="footer-email">
          <h2>{{ $t("Leave your email") }}</h2>
          <div>
            <div class="input">
              <label for="email">
                <img src="../../assets/svg/message1.svg" alt="mes" />
              </label>
              <input
                id="email"
                v-model="email"
                type="email"
                placeholder="pochtaemail@bk.ru"
              />
            </div>
            <div v-if="$v.email.$dirty && !$v.email.required" class="invalid">
              {{ $t("Required field") }}
            </div>
            <div v-else-if="$v.email.$dirty && !$v.email.email" class="invalid">
              {{ $t("The email address is specified incorrectly") }}
            </div>
            <button class="btn" @click="onSubmit">
              {{ $t("Submit")
              }}<img src="../../assets/svg/send.svg" alt="send" />
            </button>
          </div>
        </div>
      </div>

      <div class="footer-copyright">
        <div class="footer-copyright-main">
          {{ $t("Website development:") }}
          <a href="https://it-sg.uz/">IT SOLUTION GROUP</a>
        </div>
        <div>
          <p>
            {{ $t("The site has no age restrictions") }}
            <span class="footer-icons">0+</span>
          </p>
          <a href="#"><i class="fa-solid fa-angle-up" /></a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { required, email } from "vuelidate/lib/validators";
export default {
  data() {
    return {
      email: "",
    };
  },
  validations: {
    email: {
      required,
      email,
    },
  },
  computed: {
    ...mapGetters(["getFooterMenu", "getSocial", "getEmail", "getPhone"]),
  },
  async mounted() {
    if (!(this.getFooterMenu && this.getFooterMenu.length !== 0)) {
      try {
        await this.fetchFooter();
      } catch ({ message }) {
        this.$notify(message);
      }
    }
    if (!(this.getSocial && this.getSocial.length !== 0)) {
      try {
        await this.fetchSocial();
      } catch ({ message }) {
        this.$notify(message);
      }
    }
  },
  methods: {
    ...mapActions(["fetchFooter", "fetchSocial"]),
    async onSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.submitStatus = "ERROR";
      } else {
        try {
          const form = this.toFormData({ email: this.email });
          await this.$axios.post("/api/subscribe", form);
          this.email = "";
          this.$notify({
            type: "success",
            text: "Email успешно добавлен!",
          });
        } catch ({ response }) {
          const {
            data: { data },
          } = response;
          this.$notify({
            title: "Ошибка",
            type: "error",
            text: data.message,
          });
        }
      }
    },
  },
};
</script>
