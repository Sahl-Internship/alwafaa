<template>
  <div class="main-div">
    <!-- Start Blue section -->
    <div class="col-12 row justify-center blue-section">
      <div class="col-11 row q-px-sm">

        <div class="col-8 row items-between q-mt-md">
          <q-breadcrumbs
            separator=">"
            separator-color="grey-3"
            active-color="grey-3"
          >
            <q-breadcrumbs-el label="الرئيسية" class="text-grey-2" to="/" />
            <q-breadcrumbs-el label="الدورات" class="text-grey-2" to="/courses" />
            <q-breadcrumbs-el label="اللغة العربية" class='text-white' />
          </q-breadcrumbs>
          <!-- </div> -->
          <div class="col-11 title-section">
            <p class="main-title text-white">دورة تعلم اساسيات اللغة القواعد النحوية المرحلة الاولى من 2021</p>
            <p class="sub-title text-white">تعليم اهم قواعد النحو من الصفر إلى اتقان الإعراب بكل سهولة</p>
          </div>

          <div class="col-11 row justify-between">
            <div class="row items-center">
              <q-avatar>
                <q-img src="https://cdn.quasar.dev/img/boy-avatar.png" />
              </q-avatar>
              <div class="text-h6 text-white q-ml-sm">ebtsam ali</div>
            </div>
          </div>
        </div>

        <div class="row col-4 btns-section justify-end self-end q-mb-xl">
          <q-btn
            label='الاشتراك في الدورة'
            size='lg'
            :dense='dense'
            class="col-11 text-grey-5 bg-green"
            @click="joinCourse"
          ></q-btn>

          <div class="col-11 row justify-between q-mt-lg">
            <q-btn
              flat
              size="20px"
              align="between"
              class="main-section__btn text-white transparent"
              style="width: 49%"
            >
              <img src="images/Box/play-icon.png" class="btn-icon">
              <div class="text-h6">دروس الدورة</div>
            </q-btn>

            <q-btn
              flat
              size="20px"
              align="between"
              class="main-section__btn text-white transparent"
              style="width: 49%"
            >
              <img src="images/Box/share.png" class="btn-icon">
              <div class="text-h6">مشاركة الدورة</div>
            </q-btn>
          </div>

        </div>
      </div>
    </div>
    <!-- End Blue Section -->

    <!-- Start Course info Main section -->
    <div class="row bg-grey-2">
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
  height: 430px;
}
.btns-section{
  // top: 100px;
  height: 150px;
}
.main-title{
  font-size: calc(1.5rem + 1vw);
  font-weight: bold;
  // width: 75%;
}
.sub-title{
  font-size: calc(0.4rem + 1vw);
  font-weight: bold;
}
.main-section__btn{
  border: 1px solid #fff;
  border-radius: 4px;
  .btn-icon{
    width: 20px;
    height: 20px;
  }
}
</style>
