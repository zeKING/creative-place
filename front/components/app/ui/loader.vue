<template>
  <div class="loader_block">
    <img src="~/assets/images/main-logo.png" alt="" />
  </div>
</template>

<script></script>

<style scoped>
.loader_block {
  position: absolute;
  left: 0;
  top: 0;
  width: 100vw;
  height: 100vh;
  z-index: 99999;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #21242b;
}
.loader_block > img {
  width: 190px;
  height: 170px;

  -webkit-animation: zoom 4s linear infinite;
  -moz-animation: zoom 4s linear infinite;
  -o-animation: zoom 4s linear infinite;
  animation: zoom 2.7s linear infinite;
}

@-webkit-keyframes zoom {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
  50% {
    -webkit-transform: scale(0.8);
    transform: scale(0.8);
  }
  to {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}

@-moz-keyframes zoom {
  0% {
    -moz-transform: scale(1);
    transform: scale(1);
  }
  50% {
    -moz-transform: scale(0.8);
    transform: scale(0.8);
  }
  to {
    -moz-transform: scale(1);
    transform: scale(1);
  }
}

@-o-keyframes zoom {
  0% {
    -o-transform: scale(1);
    transform: scale(1);
  }
  50% {
    -o-transform: scale(0.8);
    transform: scale(0.8);
  }
  to {
    -o-transform: scale(1);
    transform: scale(1);
  }
}

@keyframes zoom {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
  }
  50% {
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    -o-transform: scale(0.8);
    transform: scale(0.8);
  }
  to {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
  }
}
</style>
