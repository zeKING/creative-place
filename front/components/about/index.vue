<template>
  <section class="about">
    <div class="container">
      <div class="title-allblock">
        <h1 class="title">
          {{ data && data.title }}
        </h1>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="about-main">
            <div class="row">
              <div class="col-xl-4 col-lg-5 col-md-6">
                <div v-if="data && data.gallery" class="about-imgs">
                  <div v-for="(item, i) of data.gallery" :key="i" :class="`about-img${i+1}`">
                    <img :src="item.img" alt="">
                  </div>
                </div>
                <!-- <a
                  href="#"
                  data-src="https://www.youtube.com/embed/GvjBBcs3oic"
                  class="our-command"
                  data-width="700"
                  data-height="500"
                  data-fancybox=""
                  data-type="iframe"
                >
                  <div class="our-command__circle">
                    <i class="fa fa-play" aria-hidden="true" />
                  </div>
                  <h1>Смотреть видеоролик</h1>
                </a> -->
              </div>
              <div class="col-xl-8 col-lg-7 col-md-6">
                <div class="about-content" v-html="data && data.content" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      data: null
    }
  },
  async mounted () {
    try {
      this.data = await this.fetchData()
    } catch ({ message }) {
      this.$notify(message)
    }
  },
  methods: {
    ...mapActions('about', ['fetchData'])
  }
}
</script>

<style scoped>
  /*about*/
  section.home{
    background:#f3f2f0;
  }

  .about .title-allblock .title:after {
            display: none;
        }

        .about-main {
            width: 100%;
            padding: 40px 30px;
            background: #FFFFFF;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            min-height: 500px;
            border-radius: 20px;
        }
        .about-imgs {
            width: 100%;
            min-height: calc(300px + 200 * (100vw /1920));
            position: relative;
        }

        .about-img1 {
            width: calc(110px + 100 * (100vw / 1920));
            height: calc(130px + 120 * (100vw / 1920));
            position: absolute;
            left: 0;
        }

        .about-img1 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .about-img2 {
          width: calc(120px + 130 * (100vw / 1920));
            height: calc(130px + 120 * (100vw / 1920));
            position: absolute;
            right: 0;
            top: 30px;
        }

        .about-img2 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .about-img3 {
          width: calc(120px + 120 * (100vw / 1920));
            height: calc(100px + 70 * (100vw / 1920));
            position: absolute;
            top: 180px;
            left: 60px;
        }

        .about-img3 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .about-content {
            font-size: calc(10px + 7 * (100vw / 1920));
            line-height: 1.47;
            color: #3A3A3A;
        }
          @media (min-width: 1920px) {
            .about-content {
              font-size: 17px;}
          }
          @media (max-width:767.98px) {
          .about-main .row {
          flex-direction: column;
        }
        .about-main .row > div  {
          display: flex;
          align-items: center;
          justify-content: center;
        }
        .about-main .row > div > .about-imgs {
          max-width: 300px;
        }
        .about-img2 {
          left:calc(40px + 120 * (100vw / 768));
        }
        }
        .about-content p {
            margin-bottom: 25px;
        }

        .about-content ul {
            list-style: none;
            margin-bottom: 25px;
        }

        .about-content ul li {
            display: flex;
            align-items: center;
        }

        .about-content ul li:before {
            content: "\f1db";
            font-family: FontAwesome;
            font-size: 8px;
            color: #FB6E01;
            margin-right: 12px;
        }

        .our-command {
            display: flex;
            align-items: center;
            margin: 0 auto;
            margin-top: 25px;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .our-command__circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #FB6E01;
            position: relative;
        }

        .our-command__circle:before {
            content: "";
            color: rgba(251, 110, 1, 0.46);
            position: absolute;
            z-index: 0;
            left: 50%;
            top: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            display: block;
            width: 50px;
            height: 50px;
            background: rgba(251, 110, 1, 0.46);
            border-radius: 50%;
            -webkit-animation: pulse-border 1500ms ease-out infinite;
            animation: pulse-border 1500ms ease-out infinite;
        }

        .about .title {
            font-family: "Nunito";
            font-style: normal;
            color: #21242b;
            font-weight: 800;
            font-size: 40px;
            line-height: 48px;
        }

        .our-command__circle i {
            font-size: 10px;
            color: #ffffff;
        }

        .our-command h1 {
            font-family: 'Montserrat', sans-serif;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 25px;
            color: #FB6E01;
            margin-left: 10px;
            margin-bottom: 0;
        }
        /*end of about*/

        .container {
            max-width: 1392px;
        }

        @-webkit-keyframes pulse-border {
            0% {
                -webkit-transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
                opacity: 1;
            }
            100% {
                -webkit-transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1.5);
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1.5);
                opacity: 0;
            }
        }

        @keyframes pulse-border {
            0% {
                -webkit-transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
                opacity: 1;
            }
            100% {
                -webkit-transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1.5);
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1.5);
                opacity: 0;
            }
        }
</style>
