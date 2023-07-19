<template>
  <div
    id="staticBackdrobesh"
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
            {{ $t('Notifications') }}
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            @click="$emit('close')"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body centerr">
          <div class="Notification">
            <div v-for="(item, i) of notifications" :key="i" class="Notification_delete" @click="toPage(item)">
              <div class="Notification_delete_data">
                <div class="xxx">
                  <span v-if="!item.isRead" />
                  <h5>{{ item.name }}</h5>
                </div>
                <p>
                  {{ item.message }}
                </p>
              </div>
              <img src="img/delete.png" alt="" @click="onDelete(item.id)">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      notifications: []
    }
  },
  async mounted () {
    try {
      if (!this.$auth.user) {
        return ''
      }
      this.notifications = await this.fetchNotification(this.$auth.user.user_id)
    } catch ({ message }) {
      this.$notify(message)
    }
  },
  methods: {
    ...mapActions('notification', ['fetchNotification', 'removeNotification']),
    async onDelete (id) {
      try {
        await this.removeNotification(id)
        this.notifications = await this.fetchNotification()
      } catch ({ message }) {
        this.$notify(message)
      }
    },
    toPage (item) {
      this.$emit('close')
      this.$router.push('/search?id=' + item.work_id)
    }
  }
}
</script>

<style>
  .Notification_delete {
    cursor: pointer;
  }
</style>
