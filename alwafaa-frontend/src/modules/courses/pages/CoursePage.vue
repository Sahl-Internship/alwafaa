<template>
  <div class="main-div">
    <!-- Start Blue section -->
    <div class="col-12 row justify-center blue-section">
      <div class="col-11 row q-px-sm">

        <div class="col-xs-12 col-sm-12 col-md-8 col-8 row items-between q-mt-md">
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

          <div class="col-11 row justify-between q-mb-lg">
            <div class="row items-center">
              <q-avatar>
                <q-img src="https://cdn.quasar.dev/img/boy-avatar.png" />
              </q-avatar>
              <div class="text-h6 text-white q-ml-sm" >ebtsam ali</div>
            </div>

            <div class="row items-center">
              <div class="text-h6 text-white">فئة الدورة: </div>
              <div class="row items-center q-pl-sm q-gutter-x-sm">
                <img src="/images/Box/Group 4877.png" width="25px" />
                <div class="text-h6 text-white">القرآن الكريم</div>
              </div>
            </div>

            <div class="row items-center">
              <div class="text-h6 text-white">آخر تحديث: </div>
              <div class="row items-center q-pl-sm q-gutter-x-sm">
                <img src="/images/Box/calender.png" width="18px" />
                <div class="text-h6 text-white">12 يناير 2021</div>
              </div>
            </div>
          </div>
        </div>

        <div class="row col-xs-12 col-sm-12 col-md-4 col-lg-4 btns-section justify-end self-end q-mb-xl">
          <q-btn
            :label='buttonTitleState'
            size='lg'
            :dense='dense'
            class="col-xs-12 col-sm-12 col-md-11 col-lg-11 text-grey-5 bg-green"
            @click="joinCourse"
          ></q-btn>

          <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11 row justify-between q-mt-lg">
            <q-btn
              flat
              size="20px"
              align="between"
              class="main-section__btn text-white transparent"
              style="width: 49%"
            >
              <img src="images/Box/play-icon2.png" class="btn-icon">
              <div class="text-h6 btn-text">دروس الدورة</div>
            </q-btn>

            <q-btn
              flat
              size="20px"
              align="between"
              class="main-section__btn text-white transparent"
              style="width: 49%"
            >
              <img src="images/Box/share.png" class="btn-icon">
              <div class="text-h6 btn-text">مشاركة الدورة</div>
            </q-btn>
          </div>

        </div>
      </div>
    </div>
    <!-- End Blue Section -->

    <!-- Start Course info Main section -->
    <div class="row col-12 bg-grey-2 q-py-xl justify-center">
        <!-- First section what you will learn and course durations -->
        <div class="row col-11 what-learn">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="text-h6 col-8 q-mb-md">ماذا ستتعلم</div>
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 course-description__section bg-grey-1 q-pa-xl" >
            <div class="col-11 requirment">
              <div class="text-h6 q-ml-xs">متطلبات الدورة</div>
              <ul class="text-grey-4 text-body1 q-mb-lg" style="padding-right:22px;">
                <li>لا توجد متطلبات قبل الدورة, ولكن توزع على المتدربين خطة الموضوعات للدورة ككل</li>
                <li>هناك متطلبات عقب كل محاضرة تتمثل في الإجابة على الأسئلة المرفقة مع مرفقات المادة</li>
                <li>هناك امتحان في آخر الدورة يتضمن كل المهارات التدريسية التي تضمنتها الدورة</li>
                <li>يتم اعطاء الطلاب واجبات بعد كل درس</li>
              </ul>
              <div class="text-h6">وصف الدورة</div>
              <div class="text-body1 text-grey-4">
                يحتاج الكثير من متعلمي اللغة العربية إلي تعلم النحو والإعراب بسهولة وسوف يتم ذلك من خلال مجموعة
                رائعة من الدروس المترابطة وطريقة الشرح التي تستطيع عمل جدول يومي لك لمراجعة النحو العربي
                اللغة العربية هي أكثر اللغات السامية تحدثا وإحدى أكثر اللغات انتشارا في العالم، يتحدثها أكثر من 467 مليون
                نسمة. ويتوزع متحدثوها في الوطن العربي، بالإضافة إلى العديد من المناطق الأخرى المجاورة كالأهواز وتركيا
                وتشاد ومالي والسنغال وإرتيريا وإثيوبيا وجنوب السودان وإيران، وبذلك فهي تحتل المركز الرابع أو الخامس من
                حيث اللغات الأكثر انتشارا في العالم، واللغة الرابعة من حيث عدد المستخدمين على الإنترنت. اللغة العربية ذات
                أهمية قصوى لدى المسلمين، فهي عندهم لغة مقدسة إذ أنها لغة القرآن، وهي لغة الصلاة وأساسية في
                القيام بالعديد من العبادات والشعائر الإسلامية العربية هي أيضا لغة شعائرية رئيسية لدى عدد من الكنائس
                المسيحية في الوطن العربي، كما كتبت بها كثير من أهم الأعمال الدينية والفكرية اليهودية في العصور الوسطى
                ارتفعت مكانة اللغة العربية إثر انتشار الإسلام بين الدول إذ أصبحت لغة السياسة والعلم والأدب لقرون طويلة.
                في الأراضي التي حكمها المسلمون. وللغة العربية تأثير مباشر وغير مباشر على كثير من اللغات الأخرى في
                العالم الإسلامي
              </div>
              <div class="text-h6 q-mt-xl q-mb-md ">ماذا ستتعلم في هذه الدورة</div>
              <div class="toggle-show1" :class="{'toggle-show1-no-gradient': isShowAll}">
                <div class="text-body1 text-grey-4">1- التمييز بين اقسام الكلمة العربية الثلاثة الاسم ,الفعل و الحرف</div>
                <div class="text-body1 text-grey-4">2- التمييز بين انواع الفعل الثلاثة الماضي ,المضارع و الامر</div>
                <div class="text-body1 text-grey-4">3- التمييز بين اقسام الكلمة العربية الثلاثة الاسم ,الفعل و الحرف</div>
              </div>
              <div class="toggle-show" :class="{'show-hidden-item': isShowAll}">
                <div class="text-body1 text-grey-4">1- التمييز بين اقسام الكلمة العربية الثلاثة الاسم ,الفعل و الحرف</div>
                <div class="text-body1 text-grey-4">2- التمييز بين انواع الفعل الثلاثة الماضي ,المضارع و الامر</div>
                <div class="text-body1 text-grey-4">3- التمييز بين اقسام الكلمة العربية الثلاثة الاسم ,الفعل و الحرف</div>
              </div>
              <div
                class="text-body1 col-12 text-center q-mt-sm show-more_description text-bold"
                @click="showAll" style="text-decoration:underline;cursor: pointer;">عرض الكل
                <img src="images/home-imgs/path 1234.png" class="q-ml-sm" style="width:10px;hegight:10px;"/>
              </div>
            </div>
          </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  course-info__section">
            <div class="text-h6 q-mb-md q-ml-lg course-info_title">معلومات الدورة</div>
            <div
              class="column justify-between no-wrap course-info q-ml-lg self-end justify-end"
            >
              <q-img src="images/home-imgs/alorefy.jpg" style="height:245px;width:100%;border-radius:4px 4px 0px 0px">
                <div class="absolute-full flex flex-center dimmed"></div>
                <img src="images/home-imgs/info-player.png" class="absolute-center flex flex-center" style="width:25px;height:25px;">
              </q-img>
                <div class="text-h6 q-mt-lg q-mb-md q-ml-lg">تشمل هذه الدورة:</div>
                <div class="row no-wrap q-ml-lg q-mb-md">
                  <div class="col-6 inline-block">
                    <img
                      src="images/Path 9266.png"
                      :class="{
                        'icon-lg': !$q.screen.lt.sm,
                        'icon-sm': $q.screen.lt.sm
                      }"
                    />
                    <div
                      class="inline-block text-grey-5"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-md': true
                      }"
                    >عدد الايام:</div>
                  </div>
                  <div class="col-6">
                    <div
                      class="text-grey-4"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                      }"
                    >30يوم</div>
                  </div>
                </div>
                <div class="row q-ml-lg q-mb-md">
                  <div class="col-6">
                    <img
                      src="images/Box/duration.png"
                      :class="{
                        'icon-lg': !$q.screen.lt.sm,
                        'icon-sm': $q.screen.lt.sm
                      }"
                    />
                    <div
                      class="inline-block text-grey-5"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-md': true
                      }"
                    >   وقت الدورة:</div>
                  </div>
                  <div class="col-6">
                    <div
                      class="text-grey-4"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-sm': true
                      }"
                    >04:20:00 ساعة</div>
                  </div>
                </div>
                <div class="row q-ml-lg q-mb-md">
                  <div class="col-6">
                    <img
                      src="images/Box/play-icon.png"
                      :class="{
                        'icon-lg': !$q.screen.lt.sm,
                        'icon-sm': $q.screen.lt.sm
                      }"
                    />
                    <div
                      class="inline-block text-grey-5"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-md': true
                      }"
                    >عدد الدروس:</div>
                  </div>
                  <div class="col-6">
                    <div
                      class="text-grey-4"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-sm': true
                      }"
                    >42 درس</div>
                  </div>
                </div>
                <div class="row q-ml-lg q-mb-lg">
                  <div class="col-6">
                    <img
                      src="images/Box/Path 8197.png"
                      :class="{
                        'icon-lg': !$q.screen.lt.sm,
                        'icon-sm': $q.screen.lt.sm
                      }"
                    />
                    <div
                      class="inline-block text-grey-5"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-md': true
                      }"
                    >عدد الطلاب:</div>
                  </div>
                  <div class="col-6">
                    <div
                      class="text-grey-4"
                      :class="{
                        'text-subtitle2': !$q.screen.lt.sm,
                        'text-caption': $q.screen.lt.sm,
                        'q-ml-sm': true
                      }"
                    > 452 طالب</div>
                  </div>
                </div>
                <div class="row q-ml-lg q-mb-md">
                  <div class="col-1">
                    <img
                      src="images/Box/hash.png"
                      :class="{
                        'icon-lg': !$q.screen.lt.sm,
                        'icon-sm': $q.screen.lt.sm
                      }"
                    />
                  </div>
                  <div class="col-11 q-pr-xl">
                    <div class="text-subtitle1 branch">النحو</div>
                    <div class="text-subtitle1 branch">القرآن</div>
                    <div class="text-subtitle1 branch">الفصاحة</div>
                    <div class="text-subtitle1 branch">المعرفة</div>
                    <div class="text-subtitle1 branch">الشعر</div>
                  </div>
                </div>
                <div class="row no-wrap q-mx-auto q-my-xl">
                  <div
                    class="text-grey-4"
                    :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1'"
                  >4.5</div>
                  <star-rating
                    read-only
                    :increment=0.5
                    :rating=4.5
                    :star-size="$q.screen.lt.md ? 13 : 20"
                    :padding="$q.screen.lt.md ? 3 : 5"
                    :active-color="['#e49d1a']"
                    :show-rating=false
                    :rtl=true
                  ></star-rating>
                  <div
                    class="text-grey-4 q-ml-sm"
                    :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1'"
                  >(454)</div>
                </div>
                <q-btn
                  :label='buttonTitleState'
                  size='lg'
                  :dense='dense'
                  class="text-grey-5 bg-green q-mx-auto q-my-lg"
                  @click="joinCourse"
                  style="width:85%"
                ></q-btn>
            </div>
          </div>
        </div>

        <!-- Start Course Classes description -->
        <course-dates></course-dates>
        <!-- Start About Teacher -->
        <about-teacher></about-teacher>
        <!-- Start About Teacher -->
        <the-comments></the-comments>
    </div>
    <!-- End Course info Main Section -->
  </div>
</template>

<script>
import StarRating from 'vue-star-rating'
import CourseDates from '../components/CourseDates.vue'
import AboutTeacher from '../components/AboutTeacher.vue'
import TheComments from '../components/TheComments.vue'
export default {
  components: { StarRating, CourseDates, AboutTeacher, TheComments },
  data () {
    return {
      date: '2019/02/01',
      dense: false,
      step: 1,
      isShowAll: false,
      isShowList: false
    }
  },
  methods: {
    joinCourse () {
      console.log(this.$router)
      const courseId = this.$route.params.id
      this.$store.dispatch('student/joinCourse', courseId)
    },
    showAll () {
      this.isShowAll = !this.isShowAll
    },
    showClassList () {
      this.isShowList = !this.isShowList
    }
  },
  computed: {
    isAuthed () {
      return this.$store.getters['auth/isAuthenticated']
    },
    buttonTitleState () {
      return this.isAuthed ? 'اكمال الدورة' : 'الاشتراك في الدورة'
    }
  }
}
</script>

<style lang='scss' scoped>
.main-div{
  overflow-y: hidden;
    .icon-lg {
    width: 15px;
    height: 15px;
  }
  .icon-sm {
    width: 10px;
    height: 10px;
  }
  .hide{
    display: none;
  }
  .show{
    display: block;
  }
}
.blue-section{
  background: #2B5078;
  background-image: radial-gradient(#FAFAFA 0.7%, transparent 1%), radial-gradient(#FAFAFA 0.8%, transparent 1%);
  background-position: 0 0, 180px 50px;
  background-size: 120px 100px;
  height: 430px;
  @media (max-width:480px) {
    height: 572px;
  }
}
.btns-section{
  height: 150px;
}
.main-title{
  font-size: calc(1.5rem + 1vw);
  font-weight: bold;
  @media (max-width:480px) {
    font-size: calc(1.1rem + 1vw);
  }
}
.sub-title{
  font-size: calc(0.4rem + 1vw);
  @media (max-width:480px) {
    font-size: calc(0.7rem + 1vw);
  }
  font-weight: bold;
}
.main-section__btn{
  border: 1px solid #fff;
  border-radius: 4px;
  .btn-text{
  @media (max-width: 480px){
      font-size: 15px !important;
    }
  }
  .btn-icon{
    width: 20px;
    height: 20px;
  }
}
.course-description__section{
  border-radius: 4px;
  @media (max-width:480px) {
    padding-left: 25px;
    padding-right: 25px;
  }
  .toggle-show{
    display: none;
  }
  .show-hidden-item{
    display: block;
  }
}
.course-info__section{
  .course-info{
    @media (max-width:480px) {
      margin: 0px;
    }
    border-radius: 4px;
    background: #fff;
  }
  .course-info_title{
    @media (max-width:480px) {
      margin-left: 0px;
      margin-top: 25px;
    }
  }
  .branch{
    background: #EEE;
    color: $grey-5;
    width: 65px;
    height: 30px;
    border-radius: 4px;
    margin: 0px 5px 5px 5px;
    display: inline-block;
    text-align: center;
  }
}
.vue-star-rating{
  &::v-deep{
    .sr-only[data-v-fde73a0c] {
      position: absolute;
      left: 0px;
      top: auto;
      width: 1px;
      height: 1px;
      overflow: hidden;
    }
  }
}
.toggle-show1{
    -webkit-mask-image: -webkit-gradient(linear, left top,
    left bottom, from(rgba(1,1,1,1)), to(rgba(1,1,1,0)));
}
.toggle-show1-no-gradient{
  -webkit-mask-image: -webkit-gradient(linear, left top,
  left bottom, from(rgba(1,1,1,1)), to(rgba(1,1,1,1)));
}
</style>
