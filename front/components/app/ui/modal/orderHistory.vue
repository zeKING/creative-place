<template>
  <div
    id="staticBackdro-plus"
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
            Добавить работу
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
          <div class="order-container">
            <div class="thead">
              <p class="name">
                Имя товара
              </p>
              <p class="status">
                Статус
              </p>
              <p class="summ">
                Цена
              </p>
            </div>
            <div class="tbody">
              <div class="product">
                <div class="product-img">
                  <img src="img/product.png" alt="product">
                  <div class="text">
                    <p>Рисунок в стиле лофт</p>
                    <p>Николаевна Анна</p>
                  </div>
                </div>
                <div class="product-status">
                  <p>Успешно</p>
                </div>
                <div class="product-summ">
                  <p>1 252 000 сум</p>
                  <div class="del">
                    <i class="fa-solid fa-trash" />
                  </div>
                </div>
              </div>
              <div class="product">
                <div class="product-img">
                  <img src="img/product.png" alt="product">
                  <div class="text">
                    <p>Рисунок в стиле лофт</p>
                    <p>Николаевна Анна</p>
                  </div>
                </div>
                <div class="product-status">
                  <p>Успешно</p>
                </div>
                <div class="product-summ">
                  <p>1 252 000 сум</p>
                  <div class="del">
                    <i class="fa-solid fa-trash" />
                  </div>
                </div>
              </div>
              <div class="product">
                <div class="product-img">
                  <img src="img/product.png" alt="product">
                  <div class="text">
                    <p>Рисунок в стиле лофт</p>
                    <p>Николаевна Анна</p>
                  </div>
                </div>
                <div class="product-status">
                  <p>Успешно</p>
                </div>
                <div class="product-summ">
                  <p>1 252 000 сум</p>
                  <div class="del">
                    <i class="fa-solid fa-trash" />
                  </div>
                </div>
              </div>
              <div class="product">
                <div class="product-img">
                  <img src="img/product.png" alt="product">
                  <div class="text">
                    <p>Рисунок в стиле лофт</p>
                    <p>Николаевна Анна</p>
                  </div>
                </div>
                <div class="product-status">
                  <p>Успешно</p>
                </div>
                <div class="product-summ">
                  <p>1 252 000 сум</p>
                  <div class="del">
                    <i class="fa-solid fa-trash" />
                  </div>
                </div>
              </div>
              <div class="product">
                <div class="product-img">
                  <img src="img/product.png" alt="product">
                  <div class="text">
                    <p>Рисунок в стиле лофт</p>
                    <p>Николаевна Анна</p>
                  </div>
                </div>
                <div class="product-status">
                  <p>Успешно</p>
                </div>
                <div class="product-summ">
                  <p>1 252 000 сум</p>
                  <div class="del">
                    <i class="fa-solid fa-trash" />
                  </div>
                </div>
              </div>
              <div class="product">
                <div class="product-img">
                  <img src="img/product.png" alt="product">
                  <div class="text">
                    <p>Рисунок в стиле лофт</p>
                    <p>Николаевна Анна</p>
                  </div>
                </div>
                <div class="product-status">
                  <p>Успешно</p>
                </div>
                <div class="product-summ">
                  <p>1 252 000 сум</p>
                  <div class="del">
                    <i class="fa-solid fa-trash" />
                  </div>
                </div>
              </div>
              <div class="product">
                <div class="product-img">
                  <img src="img/product.png" alt="product">
                  <div class="text">
                    <p>Рисунок в стиле лофт</p>
                    <p>Николаевна Анна</p>
                  </div>
                </div>
                <div class="product-status">
                  <p>Успешно</p>
                </div>
                <div class="product-summ">
                  <p>1 252 000 сум</p>
                  <div class="del">
                    <i class="fa-solid fa-trash" />
                  </div>
                </div>
              </div>
              <div class="product">
                <div class="product-img">
                  <img src="img/product.png" alt="product">
                  <div class="text">
                    <p>Рисунок в стиле лофт</p>
                    <p>Николаевна Анна</p>
                  </div>
                </div>
                <div class="product-status">
                  <p>Успешно</p>
                </div>
                <div class="product-summ">
                  <p>1 252 000 сум</p>
                  <div class="del">
                    <i class="fa-solid fa-trash" />
                  </div>
                </div>
              </div>
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
      list: []
    }
  },
  async mounted () {
    await this.getList()
  },
  methods: {
    ...mapActions('projects', ['fetchFavorite']),
    async getList () {
      try {
        this.list = await this.fetchFavorite()
      } catch ({ message }) {
        this.$notify(message)
      }
    }
  }
}
</script>
