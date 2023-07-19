<template>
  <section class="children section-space">
    <div class="container">
      <div class="children-text help-children-main-text">
        <div>
          <h2>{{ $t("Help those who need it most!") }}</h2>
          <p>
            {{
              $t(
                "Children try to do everything in their power to benefit society."
              )
            }}
          </p>
        </div>
        <div>
          <a
            href="javascript:void(0)"
            @click.prevent="$router.push('/children')"
          >
            <span>{{ $t("View all") }} </span>
            <i class="fa-solid fa-arrow-right" />
          </a>
        </div>
      </div>
      <div class="children-wrapper">
        <div
          v-for="(item, i) of children"
          :key="i"
          class="children-card"
          @click="$router.push('/children/' + item.user_id)"
        >
          <div class="children-img">
            <img :src="item.photo" :alt="item.name" />
          </div>
          <div class="card-data">
            <h4>{{ item.name }}</h4>
            <p class="children-old">{{ item.age }} {{ $t("year") }}</p>
            <p>
              {{ item.about_me }}
            </p>
          </div>
          <div class="children-card-footer">
            <p>
              <i class="fa-solid fa-briefcase" /> {{ item.count_work }}
              {{ $t("works") }}
            </p>
            <button class="card-btn">
              {{ $t("go") }} <i class="fa-solid fa-right-long" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      children: [],
    };
  },
  async created() {
    try {
      this.children = await this.fetchChildren();
    } catch ({ message }) {
      this.$notify(message);
    }
  },
  methods: {
    ...mapActions("home", ["fetchChildren"]),
  },
};
</script>

<style>
.children-card {
  cursor: pointer;
}
</style>
