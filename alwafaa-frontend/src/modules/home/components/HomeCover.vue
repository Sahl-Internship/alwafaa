<template>
  <div class="q-pa-none col-12 text-center q-mb-xl main">
    <q-img
      src='/images/home-imgs/header.png'
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
        <div class="auto-complete row col-12 relative-position">
          <q-input
            outlined
            v-model="search"
            :label="$t('homeCover.search')"
            bg-color="white"
            maxlength="12"
            class="col-xs-9 col-sm-5 col-md-5 col-lg-5 column q-mt-lg q-mx-auto input-field "
            appendIconName= 'search'
            @input="onChange"
          >
            <template v-slot:append>
              <q-icon name="search"/>
            </template>
          </q-input>
          <ul
            v-show="isOpen"
            class="autocomplete-results row col-xs-9 col-sm-5 col-md-5 col-lg-5"
          >
            <li
              v-for="(result, i) in results"
              :key="i"
              @click="setResult(result.id)"
              class="autocomplete-result"
            >
              {{ result.title }}
            </li>
          </ul>
        </div>
        <div
          class="col-12 q-mb-lg"
        >
          <span> {{$t('homeCover.suggest')}}</span>
          <router-link to='/'> {{$t('homeCover.firstSuggest')}} </router-link><span>,</span>
          <router-link to='/'> {{$t('homeCover.secondSuggest')}} </router-link><span class="last-slash">,</span>
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
            src="/images/home-imgs/square-vid.png"
            class="vid-img q-ma-xs"
            :class="{'hide' : show}"
          >
            <div
              class="overlay absolute-full flex flex-center"
            >
              <q-img
                src="/images/home-imgs/play-vid.png"
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
      show: false,
      search: '',
      results: ['no matched results'],
      isOpen: false
      // courses: [
      //   {
      //     name: 'المستوى الاول في اللغة العربية',
      //     id: 7
      //   },
      //   {
      //     name: 'تحفيظ القران الكريم',
      //     id: 6
      //   },
      //   {
      //     name: 'المستوى الثاني في اللغة العربية',
      //     id: 9
      //   },
      //   {
      //     name: 'الاحاديث النبوية ',
      //     id: 8
      //   },
      //   {
      //     name: 'دراسة القراءات المتنوعة ',
      //     id: 10
      //   }
      // ]
    }
  },
  methods: {
    showVideo () {
      this.show = !this.show
      this.autoplay = !this.autoplay
    },
    setResult (id) {
      // this.search = result
      this.isOpen = false
      this.$router.push('/courses/' + id)
    },
    onChange () {
      this.isOpen = true
      this.filterResults()
    },
    filterResults () {
      // this.results = this.courses.filter(course => course.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1)
      this.results = this.courses.filter(course => course.title.toLowerCase().includes(this.search.toLowerCase()))
    }
  },
  watch: {
    search (value) {
      if (value === '') {
        this.isOpen = false
      }
    }
  },
  computed: {
    autoPlayMethod () {
      return this.autoplay
    },
    courses () {
      return this.$store.getters['home/getCourses']
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
      .autocomplete-results {
        position: absolute;
        padding: 5px;
        margin-left: -11px;
        background: #fff;
        left: 30%;
        top: 67px;
        border-radius: 3px;
        border: 1px solid #eeeeee;
        height: 120px;
        // width: 100%;
        z-index: 1000;
        overflow: hidden;
        @media (max-width: 340px), (max-width: 480px){
          left: 16%;
        }
      }

      .autocomplete-result {
        list-style: none;
        text-align: left;
        padding: 4px 2px;
        color: $green;
        display: block;
        width: 100%;
        cursor: pointer;
      }

      .autocomplete-result:hover {
        background-color: $green;
        color: white;
      }
      p{
        font-size: calc(1rem + 1vw);
        font-weight: bold;
        @media (max-width: 480px){
          font-weight: normal;
        }
        @media (max-width: 340px){
          font-weight: normal;
          margin-bottom: 9px;
        }
      }
      .p2{
        text-align: center;
        font-size: calc(0.02rem + 1vw);
        font-weight: normal;
        @media(max-width: 767px){
        }
        @media (max-width: 480px){
          font-size: calc(0.4rem + 1vw);
        }
        @media (max-width: 340px){
          font-weight: normal;
        }
      }
      span{
        color: #fff;
        margin: 0px 5px;
        @media(max-width: 767px){
          font-size: 12px;
        }
      }
      a{
        text-decoration: none;
        color: #fff;
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
