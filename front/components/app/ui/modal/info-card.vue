<template>
  <div
    id="staticBackdro-bell"
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
            Информация о карте
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
          <form action="#" class="bell-form">
            <div class="card-number">
              <label for="card-number">Номер карты</label>
              <input
                id="card-number"
                type="text"
                placeholder="****-****-****-****"
              >
            </div>

            <div class="card-data">
              <div class="card-code">
                <label for="card-code">CVV код</label>
                <input id="code" type="text" placeholder="***">
              </div>
              <div class="card-date">
                <label for="card-date">Годен до</label>
                <input
                  id="card-date"
                  type="text"
                  placeholder="ММ/ГГ"
                >
              </div>
            </div>

            <div class="card-name">
              <label for="card-name">Имя на карте</label>
              <input
                id="card-name"
                type="text"
                placeholder="****-****-****-****"
              >
            </div>
            <button
              class="btn bell-btn"
              data-dismiss="modal"
              aria-label="Close"
              data-toggle="modal"
              data-target="#staticBackdro-bell-2"
            >
              Проверить
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
