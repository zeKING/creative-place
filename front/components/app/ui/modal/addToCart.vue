<template>
  <div
    id="staticBackdrop"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <client-only>
      <CoolLightBox
        ref="lightbox"
        :items="items"
        :index="index"
        @close="index = null"
      />
    </client-only>
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="staticBackdropLabel" class="modal-title">
            {{ $t('Add a job') }}
          </h5>
          <button type="button" class="close" @click="$emit('close')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="onSubmit">
            <div class="form_left">
              <label for="ish">{{ $t('Name of the work') }}</label>
              <input
                id="ish"
                v-model="form.name"
                type="text"
                :placeholder="$t('For example: Family portrait')"
              >

              <label for="cars">{{ $t('Tag (collection name)') }}</label>
              <select id="cars" v-model="form.tag_id">
                <option v-for="item of tags" :key="item.id" :value="item.id">
                  {{ item.title }}
                </option>
              </select>

              <label for="som">{{ $t('Price') }}</label>
              <input
                id="som"
                v-model="form.price"
                type="text"
                :placeholder="$t('For example: 1,250,000 sum')"
              >

              <label for="ta">{{ $t('Description') }}</label>
              <textarea
                id="ta"
                v-model="form.message"
                name=""
                cols="30"
                rows="10"
                :placeholder="$t('Write more about your project')"
              />
            </div>
            <div class="form_right">
              <div class="form_right_file">
                <div class="file_data">
                  <input type="file" @change="onChange">
                  <img src="img/plus.png" alt="plus">
                  <p>
                    {{ $t('Drag and drop the project image or click') }}
                    <span>«Плюс»</span>
                  </p>
                </div>
              </div>
              <div v-if="fileError" class=" mt-2 invalid">
                {{ fileError }}
              </div>
              <img v-if="photo" :src="photo" alt="" class="thumb" @click="onClickImage">

              <button>
                {{ $t('Publish') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import CoolLightBox from 'vue-cool-lightbox'
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css'
export default {
  components: {
    CoolLightBox
  },
  data () {
    return {
      tags: [],
      photo: null,
      items: [],
      index: null,
      form: { name: '', tag_id: '', file: null, message: '', price: '', user_id: '' },
      fileError: ''
    }
  },
  async mounted () {
    try {
      this.tags = await this.fetchTags()
    } catch ({ message }) {
      this.$notify(message)
    }
  },
  methods: {
    ...mapActions('profile', ['fetchTags', 'addWork']),
    onChange (event) {
      this.fileError = ''
      this.form.file = event.target.files[0]
      if (!this.form.file) {
        return ''
      }
      if (this.form.file && this.form.file.type !== 'image/jpeg') {
        this.fileError = 'Можно загружать только файлы типа jpeg'
      }
      if (this.form.file && this.form.file.size > 1024 * 1024 * 5) {
        this.fileError = 'Размер файла не должен превышать 5mb'
      }
      this.photo = URL.createObjectURL(event.target.files[0])
    },
    async  onSubmit () {
      try {
        if (this.fileError) {
          return ''
        }
        this.form.user_id = this.$auth.user.user_id
        const form = this.toFormData(this.form)
        await this.addWork(form)
        this.$emit('fetchData')
        this.$emit('close')
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    onClickImage () {
      this.items = [{ src: this.photo }]

      this.index = 0
    }
  }

}
</script>

<style>
.thumb {
  width: 100px;
  height: 100px;
}
</style>
