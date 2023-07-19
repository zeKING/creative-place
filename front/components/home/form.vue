<template>
  <section class="login-item section-space">
    <div class="container">
      <h2>{{ $t("Do you have any questions?") }}</h2>
      <div class="login-wrapper">
        <div class="login-content">
          <p>{{ $t("Leave your details and we will contact you!") }}</p>
          <form @submit.prevent="onSubmit">
            <h4>{{ $t("name") }}</h4>
            <div class="name">
              <label for="name"><i class="fa-solid fa-address-card" /></label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                :placeholder="$t('Enter your name')"
              />
            </div>
            <h4>{{ $t("Mail") }}</h4>
            <div class="email">
              <label for="email"><i class="fa-solid fa-envelope" /></label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                placeholder="pochtaemail@bk.ru"
              />
            </div>
            <h4>{{ $t("Phone") }}</h4>
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
                v-mask="`${selectPhone}#########`"
                type="tel"
                :placeholder="selectPhone"
              />
            </div>
            <client-only>
              <recaptcha />
            </client-only>
            <button class="btn">
              {{ $t("Submit") }}<i class="fa-brands fa-telegram" />
            </button>
          </form>
        </div>
        <div class="login-img">
          <img src="img/ab1.png" alt="" />
        </div>
      </div>
    </div>
    <client-only>
      <sweet-modal ref="modal" icon="success">
        {{ $t("The data has been sent successfully!") }}
      </sweet-modal>
    </client-only>
  </section>
</template>

<script>
import { mapActions } from "vuex";
import { SweetModal } from "sweet-modal-vue";
export default {
  components: {
    SweetModal,
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
      },
      object: {
        name: "Object Name",
      },
      phones: [],
      selectPhone: "",
    };
  },
  async mounted() {
    await this.getPhones();
  },
  methods: {
    ...mapActions("form", ["sendQuestions", "fetchPhones"]),
    async onSubmit() {
      try {
        try {
          await this.$recaptcha.getResponse();
        } catch (error) {
          this.$notify({
            type: "error",
            text: "Подтвердите что вы не робот!",
          });
          return;
        }

        await this.sendQuestions(this.form);
        this.$refs.modal.open();
        await this.$recaptcha.reset();
        this.form = {
          name: "",
          email: "",
          phone: "",
        };
      } catch ({ message }) {
        this.$notify(message);
      }
    },
    async getPhones() {
      try {
        this.phones = await this.fetchPhones();
        this.selectPhone = this.phones[0].code;
      } catch ({ message }) {
        this.$notify(message);
      }
    },
    onSelect(item) {
      this.selectPhone = item.code;
    },
  },
};
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
</style>
