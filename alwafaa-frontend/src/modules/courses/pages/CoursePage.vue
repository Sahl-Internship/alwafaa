<template>
    <div class="main-div">
        <!-- Start Blue section -->
        <div class="row col-12 q-px-xl blue-section">
            <div class="col-8 q-mt-md q-ml-lg">
              <q-breadcrumbs
                separator=">"
                separator-color="grey-3"
                active-color="grey-3"
              >
                <q-breadcrumbs-el label="الرئيسية" class="text-grey-2" to="/" />
                <q-breadcrumbs-el label="الدورات" class="text-grey-2" to="/courses" />
                <q-breadcrumbs-el label="اللغة العربية" class='text-white' />
              </q-breadcrumbs>
            </div>
            <div class="col-8 title-section">
              <p class="main-title text-white q-ml-lg">دورة تعلم اساسيات اللغة القواعد النحوية المرحلة الاولى من 2021</p>
              <p class="sub-title text-white q-ml-lg">تعليم اهم قواعد النحو من الصفر إلى اتقان الإعراب بكل سهولة</p>
            </div>
            <div class="row col-4 btns-section">
              <q-btn
                label='الاشتراك في الدورة'
                size='lg'
                :dense='dense'
                class="col-11 text-grey-5 bg-green"
                @click="joinCourse"
              ></q-btn>
              <q-btn
                label='دروس الدورة'
                size="lg"
                flat
                class="main-section__btn col-5 text-white transparent q-mr-md q-mt-lg"
              >
                <img src="images/box/play-icon.png" class="btn-icon" alt="">
              </q-btn>
              <q-btn
                label='مشاركة الدورة'
                size="lg"
                flat
                class="main-section__btn col-5 text-white transparent q-ml-md q-mt-lg"
              >
                <img src="images/box/share.png" class="btn-icon" alt="">
              </q-btn>
            </div>
        </div>
        <!-- End Blue Section -->

        <!-- Start Course info Main section -->
        <div class="row">
            <!-- First section what you will learn and course durations -->
            <div class="row what-learn">
                <div class="col-8 course-description__section"></div>
                <div class="col-4 course-info__section"></div>
            </div>

            <!-- Start Course Classes description -->
            <div class="row"></div>
        </div>
        <!-- End Course info Main Section -->
    </div>
</template>

<script>
export default {
  data () {
    return {
      dense: false
    }
  },
  methods: {
    joinCourse () {
      console.log(this.$router)
      const courseId = this.$route.params.id
      this.$store.dispatch('student/joinCourse', courseId)
    }
  }
}
</script>

<style lang='scss' scoped>
.blue-section{
  background: #2B5078;
  height: 500px;
}
.btns-section{
  // top: 100px;
  height: 150px;
}
.main-title{
  font-size: calc(1rem + 1vw);
  font-weight: bold;
  width: 75%;
}
.sub-title{
  font-size: calc(0.4rem + 1vw);
  font-weight: bold;
}
.main-section__btn{
  border: 1px solid #fff;
  border-radius: 4px;
  .btn-icon{
    width: 30px;
    height: 30px;
  }
}
</style>
