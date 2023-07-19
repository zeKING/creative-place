<template>
  <div
    id="staticBackdro-bell-2"
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
            Проверить
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
          <div class="aaa">
            <div class="aaa_div">
              <span>
                <h4>Итого</h4>
                <h4>1 300 000 сум</h4>
              </span>
              <span>
                <p>Товары, 1 шт.</p>
                <p>1 252 000 сум</p>
              </span>
              <span>
                <p>Доставка</p>
                <p>48 000 сум</p>
              </span>
            </div>
            <div class="aaa_div">
              <span>
                <p>Товары, 1 шт.</p>
                <h6>1111-2222-3333-4444</h6>
              </span>
              <span>
                <p>Доставка</p>
                <h6>Рустамжон Абдуллаев</h6>
              </span>
              <span>
                <p>Товары, 1 шт.</p>
                <h6>02/26</h6>
              </span>
              <span>
                <p>Доставка</p>
                <h6>177</h6>
              </span>
            </div>
            <button
              type="button"
              class="btn bell-btn"
              data-dismiss="modal"
              aria-label="Close"
              data-toggle="modal"
              data-target="#staticBackdro-bell-4"
            >
              платить
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
