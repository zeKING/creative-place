<template>
  <div
    id="exampleModalseorch"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-content-search">
        <div class="modal-body">
          <label for="seorch">{{ $t('Site Search') }}</label>
          <button
            type="button"
            class="close search-close"
            data-dismiss="modal"
            aria-label="Close"
            @click="$emit('close')"
          >
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="searchs">
            <input
              type="text"
              :placeholder="`${$t('For example')}: Рисунок в стиле лофт`"
              @input="onInput"
            >
            <i class="fa-solid fa-magnifying-glass" />
          </div>
          <template v-if="answers && answers.length > 0">
            <div v-for="item of answers" :key="item.id" class="answer" @click="toPage(item.id)">
              {{ item.name }}
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      answers: []
    }
  },
  methods: {
    async onInput (e) {
      try {
        const { data: { data } } = await this.$axios.get('/api/search', {
          params: {
            word: e.target.value
          }
        })
        this.answers = data
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    toPage (id) {
      this.$router.push(`/search?id=${id}`)
      this.$emit('close')
    }
  }
}</script>
<style>
.search-close {
  background: transparent;
}
.answer{
  padding: 5px 0 5px 10px;
  cursor: pointer;
}
.answer:not(:last-child) {
  border-bottom: 1px solid #e6e9ec;
}
</style>
