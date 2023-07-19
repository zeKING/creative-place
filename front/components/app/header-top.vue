<template>
  <div>
    <div class="search_div">
      <div class="search_div_img">
        <div class="container">
          <div class="search_icon">
            <input type="text" placeholder="Поиск по сайту" @input="onInput" />
            <i class="fa-solid fa-magnifying-glass" />
          </div>
          <div v-if="answers && answers.length > 0" class="answer-wrapper">
            <div
              v-for="item of answers"
              :key="item.id"
              class="answer"
              @click="toPage(item.id)"
            >
              {{ item.name }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      answers: [],
    };
  },
  methods: {
    async onInput(e) {
      try {
        const {
          data: { data },
        } = await this.$axios.get("/api/search", {
          params: {
            word: e.target.value,
          },
        });
        this.answers = data;
      } catch ({ message }) {
        this.$notify(message);
      }
    },
    toPage(id) {
      this.$router.push(`/search?id=${id}`);
      this.$emit("close");
    },
  },
};
</script>
  <style>
.search-close {
  background: transparent;
}
.answer {
  margin: 10px 0 0 10px;
  cursor: pointer;
}
</style>
