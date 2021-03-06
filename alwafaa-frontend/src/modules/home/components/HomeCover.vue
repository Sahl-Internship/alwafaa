<template>
  <div class="q-pa-none col-12 text-center q-mb-xl main">
    <q-img
      src='~assets/home-imgs/header.png'
      class="img col-12 text-center justify-center items-center"
      flat
    >
      <div
        class="search-section row col-6 text-center"
        style="margin-left:auto; margin-right:auto"
      >
        <p
          class="text-white col-8 q-mx-auto"
        > {{$t('homeCover.startJourney')}}
        </p>
        <p
          class="text-white col-8 p2 q-mx-auto"
        >
          {{$t('homeCover.manyCourses')}}
        </p>
        <q-input
          outlined
          v-model="text"
          :label="$t('homeCover.search')"
          bg-color="white"
          maxlength="12"
          class="col-xs-9 col-sm-5 col-md-5 col-lg-5 row column q-mt-lg q-mx-auto"
        >
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
        <div
          class="col-12 q-mb-lg"
        >
          <span> {{$t('homeCover.suggest')}}</span>
          <router-link to='/'> {{$t('homeCover.firstSuggest')}} </router-link><span>/</span>
          <router-link to='/'> {{$t('homeCover.secondSuggest')}} </router-link><span class="last-slash">/</span>
          <router-link class="last-link" to='/'>{{$t('homeCover.thirdSuggest')}} </router-link>

        </div>
        <div class="col-12">
          <g-btn
            no-caps
            :label="$t('homeCover.startNow')"
            text-color='dark'
            class="q-px-lg q-mr-auto q-ml-auto q-mt-lg start-btn display-block"
          />
        </div>
      </div>
      <span class="skew"></span>
    </q-img>

      <div
        class="row square-video q-mr-auto q-ml-auto"
      >
        <div
          class="col-12"
        >
          <youtube
            :video-id="videoId"
            :player-width="width"
            :player-height="height"
            :player-vars="{autoPlayMethod , start: 69}"
            class="youtube"
            :class="{'show': autoplay}"
          >
          </youtube>

          <q-img
            src="~assets/home-imgs/square-vid.png"
            class="vid-img q-ma-xs"
            :class="{'hide' : show}"
          >
            <div
              class="overlay absolute-full flex flex-center"
            >
              <q-img
                src="~assets/home-imgs/play-vid.png"
                class="play-vid"
                :class="{'hide' : show}"
                @click="showVideo"
              />
            </div>
          </q-img>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  components: {
  },
  data () {
    return {
      slide: 1,
      autoplay: false,
      dense: true,
      videoId: '2MgspN-0Uns',
      height: '100%',
      width: '100%',
      show: false
    }
  },
  methods: {
    showVideo () {
      this.show = !this.show
      this.autoplay = !this.autoplay
    }
  },
  computed: {
    autoPlayMethod () {
      return this.autoplay
    }
  }
}
</script>

<style lang='scss' scoped>
.main{
  position: relative;
  margin-bottom: 280px;
  height: auto;
  @media (max-width: 360px),(max-width: 480px){
    margin-bottom: 450px;
    height: 640px;
  }
  .img{
    position: relative;
    margin-bottom: 100px;
    overflow: hidden;
    @media (max-width: 600px){
    width: 100%;
    height: 100%;
    max-width: 800px;
    max-height: 650px;
    }
    @media(max-width: 480px){
      margin-bottom: 0px;
    }
    .search-section{
      background: transparent;
      top:300px;
      margin-top:-100px;
      @media (max-width: 992px){
        margin-top: -150px;
      }
      @media (max-width: 767px){
        margin-top: -250px;
      }
      @media (max-width: 480px){
        margin-top: -100px;
      }
      @media (max-width: 340px){
        margin-top: 0%;
      }
      p{
        font-size: calc(1rem + 1vw);
        // font-size: 35px;
        font-weight: bold;
        @media(max-width: 992px){
          // font-size: 25px;
        }
        @media(max-width: 767px){
          // font-size: 15px;
        }
        @media (max-width: 480px){
          // font-size: 15px;
          font-weight: normal;
        }
        @media (max-width: 340px){
          // font-size: 13px;
          font-weight: normal;
          margin-bottom: 9px;
        }
      }
      .p2{
        text-align: center;
        font-size: calc(0.02rem + 1vw);
        font-weight: normal;
        // font-size: 15px;
        @media(max-width: 992px){
          // font-size: 12px;
        }
        @media(max-width: 767px){
          // font-size: 9px;
        }
        @media (max-width: 480px){
          // font-size: 11px;
          font-size: calc(0.4rem + 1vw);
        }
        @media (max-width: 340px){
          // font-size: 11px;
          font-weight: normal;
        }
      }
      span{
        color: #fff;
        margin: 0px 5px;
        @media(max-width:480px),(max-width: 340px){
          // display: none;
        }
        @media(max-width: 767px){
          font-size: 12px;
        }
      }
      a{
        text-decoration: none;
        color: #fff;
        @media(max-width:480px),(max-width: 340px){
        // display: none;
        }
        @media(max-width: 767px){
          font-size: 12px;
        }
      }
      .last-slash,
      a.last-link{
        @media (max-width: 340px), (max-width: 480px){
          display: none;
        }
      }
    }

  .skew{
    position: absolute;
    bottom: -100%;
    left:0;
    width: 100%;
    height: 100%;
    background: #fff;
    transform: skewY(534deg);
    transform-origin: bottom left;
    @media (max-width:480px),(max-width: 340px),(max-width: 767px) {
      display: none;
    }
  }
}

  .hide{
    display: none;
  }
  .square-video{
  width: 60%;
  height: 500px;
  position: absolute;
  bottom:0;
  left: 0;
  right: 0;
  margin-bottom: -200px;
  margin-left: auto;
  background: $white;
  border-radius:5px;
  color: $dark;
  box-shadow: 0px 8px 8px 0px $grey-3;
    .youtube{
    position: absolute;
    margin:  0.5% 1%;
    height: 98%;
    width: 98%;
    opacity: 0;
  }
    .show{
    opacity: 1;
  }
  @media (max-width:992px) {
    width: 400px;
    height: 270px;
    margin-bottom: -50px;
    // margin-left: 25%;
  }
  @media (max-width:767px) {
    width: 300px;
    height: 250px;
    margin-bottom: -30px;
    // margin-left: 23%;
  }
    @media (max-width:480px) {
     margin-bottom: -375px;
  }
  .vid-img{
    height: 94%;
    width: 98%;
    opacity: 1;
    z-index:  1000;
    @media(max-width:767px){
      width: 96%;
    }
    @media(max-width: 480px){
      height: 95%;
      margin-top: 6px;
    }
    .play-vid{
      width: 100px;
      height: 100px;
      opacity: 1;
      @media (max-width:767px) {
        width: 50px;
        height: 50px;
      }
    }
  }
}
}

</style>
      <!-- <video-embed :params="{autoplay: 1}" src="https://www.youtube.com/embed/2MgspN-0Uns" ></video-embed>
      v-video-embed
      -->
