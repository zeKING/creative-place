<template>
  <div
    id="staticBackdro-bell-4"
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
          <!-- card-end -->
          <div class="card-end">
            <div class="chec">
              <img src="img/chec.png" alt="chec">
            </div>
            <h2>Спасибо за покупку!</h2>
            <p>
              Спасибо за вашу благотворительность. Вы можете
              увидеть свой продукт в истории заказов.
            </p>
            <button
              class="btn"
              data-dismiss="modal"
              aria-label="Close"
            >
              История заказов
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
