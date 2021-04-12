<template>
  <div class="main-div">
    <!-- Start Blue section -->
    <div class="col-12 row justify-center blue-section">
      <div class="col-11 row q-px-sm">

        <div
          class="col-xs-12 col-sm-12 col-md-8 col-8 row items-between q-mt-md"
        >
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
            <p class="main-title text-white">{{courseData.title}}</p>
            <p class="sub-title text-white">{{courseData.sub_title}}</p>
          </div>

          <div class="col-11 row justify-between q-mb-lg">
            <div class="row items-center">
              <q-avatar>
                <q-img src="https://cdn.quasar.dev/img/boy-avatar.png" />
              </q-avatar>
              <div class="text-h6 text-white q-ml-sm" v-if="courseData.teacher">
                {{courseData.teacher.name}}

              </div>
            </div>

            <div class="row items-center">
              <div class="text-h6 text-white">فئة الدورة: </div>
              <div class="row items-center q-pl-sm q-gutter-x-sm">
                <img :src='sectionImgSrc' width="25px" />
                <div class="text-h6 text-white">{{courseData.section}}</div>
              </div>
            </div>

            <div class="row items-center">
              <div class="text-h6 text-white">آخر تحديث: </div>
              <div class="row items-center q-pl-sm q-gutter-x-sm">
                <img src="/images/Box/calender.png" width="18px" />
                <div class="text-h6 text-white">
                  {{ calcDate(courseData.created_at) }}
                </div>
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
            @click="fullWidth = true"
          ></q-btn>
          <q-dialog
            v-model="fullWidth"
            full-width
            full-height
          >
            <q-card class="bg-grey-1">
              <div class='row col-11'>
                <div class="row col-12 ">
                  <span class="material-icons q-ml-lg q-pl-md q-mt-lg" @click="fullWidth = false">
                    close
                  </span>
                </div>
                <div
                  class="col-xs-12 q-ml-none q-my-xl col-md-7 row "
                  :class="{
                    'q-px-lg': !$q.screen.lt.md,
                    'q-pl-none': $q.screen.lt.md && $q.screen.lt.sm,
                    'q-pr-md': $q.screen.lt.md && $q.screen.lt.sm
                  }"
                >
                  <div  class='text-h5 col-8 q-ml-md'>متطلبات الدورة</div>
                  <ul class="col-12">
                    <li
                      class="text-body1 text-grey-4"
                    >
                      لا توجد متطلبات قبل المادة, و لكن توزع على المتدربين خطة موضوعات الدور لا توجد متطلبات قبل المادة, و لكن توزع على المتدربين خطة موضوعات الدورة
                    </li>
                    <li
                      class="text-body1 text-grey-4"
                    >
                      لا توجد متطلبات قبل المادة, و لكن توزع على المتدربين خطة موضوعات الدور لا توجد متطلبات قبل المادة, و لكن توزع على المتدربين خطة موضوعات الدورة
                    </li>
                    <li
                      class="text-body1 text-grey-4"
                    >
                      لا توجد متطلبات قبل المادة, و لكن توزع على المتدربين خطة موضوعات الدور لا توجد متطلبات قبل المادة, و لكن توزع على المتدربين خطة موضوعات الدورة
                    </li>
                  </ul>
                  <div
                    class="fileUpload text-center self-center col-12"
                    :class="{
                      'q-mx-md': !$q.screen.lt.md,
                      'q-ml-sm': $q.screen.lt.md && $q.screen.lt.sm
                      }"
                  >
                    <div class="text-body1 q-mt-lg">يرجى ارفاق الملف  و الإطلاع عليه قبل الإشتراك في الدورة</div>

                    <div class="text-body1 text-primary col-12" @click="selectImage">ارفاق الملف
                      <!-- <div
                        class="fileContainer imagePreviewWrapper "
                        :style="{ 'background-image': `url(${url})` }"
                      >
                      </div> -->
                      <input
                        id="fileId"
                        ref="fileInput"
                        type="file"
                        name="fileName"
                        accept="image/*,application/pdf"
                        style="display:none"
                        @change="pickFile"
                      >
                    </div>
                    <div class="text-body1 q-pa-xl">
                      {{fileName}}
                    </div>
                    <!-- <a
                      class="fileContainer imagePreviewWrapper"
                      :href="url"
                      target="_blank"
                    >
                      click
                    </a> -->
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-4 col-md-5  join-form">
                  <!-- <ul class="tabs-list q-ml-xl">
                    <li
                     class="q-px-md q-py-sm q-mr-xs tab1"
                     :class="{'active-tab': !activeTab,'inactive-tab':activeTab}"
                     @click="changeActive1(); setUserData"
                    >اشتراك</li>
                    <li
                     class="q-px-md q-py-sm  tab2"
                     :class="{'active-tab': activeTab,'inactive-tab': !activeTab}"
                     @click="changeActive2"
                    >اشتراك لشخص اخر</li>
                  </ul> -->
                  <div class="bg-white q-py-xl q-mx-xl white-form">
                    <ValidationObserver v-slot="{ handleSubmit }">
                      <q-form
                        @submit.prevent="handleSubmit(joinCourse)"
                        class="row q-mx-xl "
                      >
                        <ValidationProvider
                          v-if="anotherPerson"
                          name="firstname"
                          class="col-xs-12 col-sm-6 col-md-6 q-pb-xs"
                          :class="!$q.screen.lt.sm ? 'q-pr-xs' : ''"
                          rules="required"
                          v-slot="{ errors, invalid, validated }"
                        >
                          <g-input
                            outlined
                            v-model="firstname"
                            :label="$t('formFields.firstname')"
                            :dense='formDense'
                            :error="invalid && validated"
                            :error-message="errors[0]"
                            color='dark'
                            prependIconName="mdi-account"
                          />
                        </ValidationProvider>

                        <ValidationProvider
                          v-if="anotherPerson"
                          name="lastname"
                          class="col-12 col-sm-6 col-md-6 q-pb-xs"
                          rules="required"
                          v-slot="{ errors, invalid, validated }"
                        >
                          <g-input
                            outlined
                            v-model="lastname"
                            :dense='formDense'
                            :label="$t('formFields.lastname')"
                            :error="invalid && validated"
                            :error-message="errors[0]"
                            color='dark'
                            prependIconName="mdi-account"
                          />
                        </ValidationProvider>
                        <ValidationProvider
                          v-if="anotherPerson"
                          name="email"
                          class="col-12 q-pb-xs"
                          rules="email"
                          v-slot="{ errors, invalid, validated }"
                        >
                          <g-input
                            outlined
                            type="email"
                            :dense='formDense'
                            v-model="email"
                            :label="$t('formFields.email')"
                            :error="invalid && validated"
                            :error-message="errors[0]"
                            color='dark'
                            prependIconName="mdi-email"
                            :appendIconName="!!email && (!invalid || !validated) ? 'mdi-check' : null"
                            appendIconColor="green"
                            appendIconSize="sm"
                          />
                        </ValidationProvider>

                        <ValidationProvider
                          v-if="anotherPerson"
                          name="subtitle"
                          class="col-12 q-pb-xs"
                          :class="!$q.screen.lt.sm ? 'q-pr-xs' : ''"
                          rules=""
                          v-slot="{ errors, invalid, validated }"
                        >
                          <g-input
                            outlined
                            v-model="subtitle"
                            color='dark'
                            :dense='formDense'
                            :label="$t('formFields.subtitle')"
                            :error="invalid && validated"
                            :error-message="errors[0]"
                            prependIconName="mdi-account"
                          />
                        </ValidationProvider>

                        <ValidationProvider
                          v-if="anotherPerson"
                          name="country"
                          class="col-12 q-pb-xs"
                          rules=""
                          v-slot="{ errors, invalid, validated }"
                        >
                          <g-select
                            outlined
                            v-model="country"
                            :options="countriesNamesOptions"
                            color='dark'
                            :dense='formDense'
                            :label="$t('formFields.country')"
                            prependIconName="mdi-flag-variant"
                            :flag="isoCode"
                            :error="invalid && validated"
                            :error-message="errors[0]"
                          />
                        </ValidationProvider>

                        <!-- <div class="col-12 row phone"
                        >
                          <ValidationProvider
                            v-if="anotherPerson"
                            name="phone"
                            class="col-xs-9 col-sm-9 col-md-10 col-lg-10 q-pb-xs phone-input"
                            rules="required|numeric"
                            v-slot="{ errors, invalid, validated }"
                          >
                            <g-input
                              outlined
                              v-model="phone"
                              color='dark'
                              class="phone-field"
                              :dense='true'
                              :label="$t('formFields.phone')"
                              :error="invalid && validated"
                              :error-message="errors[0]"
                              prependIconName="mdi-phone"
                            />
                          </ValidationProvider>

                          <ValidationProvider
                            v-if="anotherPerson"
                            name="phone-key"
                            class="col-xs-3 col-sm-3 col-md-2 col-lg-2 q-pb-xs phone-select"
                            rules="required"
                            v-slot="{ errors, invalid, validated }"
                          >
                            <g-select
                              outlined
                              color='dark'
                              class="select"
                              :dense='true'
                              v-model="phone_key"
                              :options="dialCodesOPtions"
                              :error="invalid && validated"
                              :error-message="errors[0]"
                            />
                          </ValidationProvider>
                        </div> -->
              <div class="col-12 row phone"
              >
                <ValidationProvider
                v-if="anotherPerson"
                  name="phone"
                  class="col-xs-9 col-sm-9 col-md-9 col-lg-9 q-pb-xs phone-input"
                  rules="numeric"
                  v-slot="{ errors, invalid, validated }"
                >
                  <g-input
                    :dense='formDense'
                    borderless
                    v-model="phoneNumber"
                    :label="$t('formFields.phone')"
                    :error="invalid && validated"
                    :error-message="errors[0]"
                    prependIconName="mdi-phone"
                  />
                </ValidationProvider>

                <ValidationProvider
                v-if="anotherPerson"
                  name="phone-key"
                  class="col-xs-3 col-sm-3 col-md-3 col-lg-3  phone-select"
                  rules=""
                  v-slot="{ errors, invalid, validated }"
                >
                  <g-select
                    :dense='formDense'
                    borderless
                    v-model="phoneKey"
                    :options="dialCodesOPtions"
                    :error="invalid && validated"
                    :error-message="errors[0]"
                  />
                </ValidationProvider>
              </div>
                          <ValidationProvider
                            v-if="anotherPerson"
                            name="gender"
                            class="col-12 q-pb-xs"
                            rules="required"
                            v-slot="{ errors, invalid, validated }"
                          >
                            <g-select
                              outlined
                              :dense='formDense'
                              v-model="gender"
                              :options="genderOptions"
                              :label="$t('formFields.gender')"
                              :error="invalid && validated"
                              :error-message="errors[0]"
                              prependIconName="mdi-human-male-female"
                            />
                          </ValidationProvider>

                        <ValidationProvider
                          name="checkbox"
                          class="col-12 q-pb-xs"
                          rules="required"
                          v-slot="{ errors, invalid, validated }"
                        >
                          <q-checkbox
                            v-model="check"
                            color="dark"
                            class="text-primary"
                            :error="invalid && validated"
                            :error-message="errors[0]"
                          />
                          <label
                            class="text-subtitle2 q-mt-sm"
                          >
                            اوافق على
                            <span
                              class="text-primary"
                              style="text-decoration:underline;"
                            >
                              الشروط و الاحكام
                            </span>
                          </label>
                        </ValidationProvider>
                        <q-checkbox
                          v-model="anotherPerson"
                          color="dark"
                          class="text-primary"
                          label="الاشتراك لشخص اخر"
                        />
                        <g-btn
                          :dense='formDense'
                          label="إشتراك"
                          :width="!$q.screen.lt.md ? 'col-8' : 'col-9'"
                          :margin="['q-mt-sm']"
                          @click="joinCourse"
                        />
                        <div
                          class="text-body1 text-negative q-mt-md q-ml-xl q-pl-lg"
                          style="cursor:pointer"
                          @click="fullWidth = false"
                        >
                          إلغاء
                        </div>
                      </q-form>
                    </ValidationObserver>
                  </div>

                </div>
              </div>
            </q-card>
          </q-dialog>
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
          <div
            class="col-xs-12 col-sm-12 col-md-8 col-lg-8 course-description__section bg-grey-1 q-pa-xl "
            :class="{'full-description': autoHeight}"
          >
            <div class="col-11 requirment">
              <div
                class="text-h6 q-ml-xs"
              >متطلبات الدورة
              </div>
              <div
                class="text-grey-4 text-body1 q-mb-lg"
                style="margin-right:-17px;"
                v-html="courseData.requirement"
              >
              </div>
              <div
                class="text-h6">وصف الدورة</div>
              <div
                class="text-body1 text-grey-4 toggle-show1"
                :class="{'toggle-show1-no-gradient': isShowAll}"
                v-html="courseData.description"
              >
              </div>
              <div
                class="text-h6 toggle-show1"
                :class="{
                  'toggle-show1-no-gradient': isShowAll
                }"
              >
                نتائج الدورة
              </div>
              <div
                class="text-body1 text-grey-4 q-my-none toggle-show1"
                :class="{
                  'toggle-show1-no-gradient': isShowAll
                }"
                v-html="courseData.targeted_skills"
              >
              </div>
              <div
                class="text-body1 col-12 text-center q-mt-sm show-more_description text-bold"
                :class="{'hidden': autoHeight}"
                @click="showAll"
                style="text-decoration:underline;cursor: pointer;"
              >عرض الكل
                <img
                  src="images/home-imgs/path 1234.png"
                  class="q-ml-sm"
                  style="width:10px;hegight:10px;"
                />
              </div>
            </div>
          </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  course-info__section">
            <div class="text-h6 q-mb-md q-ml-lg course-info_title">معلومات الدورة</div>
            <div
              class="column justify-between no-wrap course-info q-ml-lg self-end justify-end"
            >
              <q-img :src="courseData.image" style="height:245px;width:100%;border-radius:4px 4px 0px 0px">
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
                    >{{courseData.days_number}}يوم</div>
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
                    >{{calcTime(courseData.duration)}} ساعة</div>
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
                    >{{courseData.sessions}} درس</div>
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
                    > {{courseData.student_number}} طالب</div>
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
                <div class="row no-wrap q-mx-auto q-my-xl" v-if="courseData.rate">
                  <div
                    class="text-grey-4"
                    :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1'"
                  >{{getRate}}</div>
                  <star-rating
                    read-only
                    :increment=0.5
                    :rating='courseData.rate.rate_average'
                    :star-size="$q.screen.lt.md ? 13 : 20"
                    :padding="$q.screen.lt.md ? 3 : 5"
                    :active-color="['#e49d1a']"
                    :show-rating=false
                    :rtl=true
                  ></star-rating>
                  <div
                    class="text-grey-4 q-ml-sm"
                    :class="$q.screen.lt.md ? 'text-caption' : 'text-subtitle1'"
                  >({{courseData.rate.voters}})</div>
                </div>
                <q-btn
                  :label='buttonTitleState'
                  size='lg'
                  :dense='formDense'
                  class="text-grey-5 bg-green q-mx-auto q-my-lg"
                  @click="fullWidth = true"
                  style="width:85%"
                ></q-btn>
            </div>
          </div>
        </div>

        <!-- Start Course Classes description -->
        <course-dates ></course-dates>
        <!-- Start About Teacher -->
        <about-teacher></about-teacher>
        <!-- Start About Teacher -->
        <the-comments :courseData= courseData.reviews></the-comments>
    </div>
    <!-- End Course info Main Section -->
  </div>
</template>

<script>
import { calcDuration, dateFormat } from 'src/utils/global.js'
import StarRating from 'vue-star-rating'
import CourseDates from '../components/CourseDates.vue'
import AboutTeacher from '../components/AboutTeacher.vue'
import TheComments from '../components/TheComments.vue'
import { dialCodes, countriesNames, getSelectedCountry } from 'src/utils/countries.js'
import { i18n } from 'src/boot/i18n'
export default {
  components: { StarRating, AboutTeacher, TheComments, CourseDates },
  props: {
    value: File
  },
  watch: {
    student: {
      handler ({ country }) {
        if (country) {
          const selectedCountry = getSelectedCountry(country, this.checkLanguage)
          this.isoCode = selectedCountry.code
          this.user.phone_key = selectedCountry.dial_code
        }
      },
      deep: true
    },
    country (newVal) {
      const selectedCountry = getSelectedCountry(newVal, this.checkLanguage)
      this.isoCode = selectedCountry.code
      this.phoneKey = selectedCountry.dial_code
    }
  },
  data () {
    return {
      url: null,
      // date: '2019/02/01',
      dense: false,
      formDense: true,
      step: 1,
      isShowAll: false,
      autoHeight: false,
      courseData: {},
      fullWidth: false,
      fullHeight: false,
      firstname: '',
      lastname: '',
      subtitle: '',
      gender: '',
      country: '',
      city: '',
      email: '',
      phoneNumber: '',
      phoneKey: '',
      fileName: '',
      student: [],
      emptyField: [],
      parent: 0,
      check: false,
      anotherPerson: false,
      genderOptions: [i18n.t('signup.female'), i18n.t('signup.male')],
      tab: 'mails',
      dialCodesOPtions: dialCodes,
      isoCode: '',
      activeTab: false
    }
  },
  methods: {
    selectImage () {
      this.$refs.fileInput.click()
    },
    pickFile () {
      const input = this.$refs.fileInput
      const file = input.files
      if (file && file[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.url = e.target.result
        }
        reader.readAsDataURL(file[0])
        this.$emit('input', file[0])
      }
    },
    joinCourse () {
      const courseId = this.$route.params.id
      if (this.anotherPerson === true) {
        this.parent = 1
      }
      const data = {
        course_id: courseId,
        firstname: this.firstname,
        lastname: this.lastname,
        phone_key: this.phoneKey,
        phone: this.phoneNumber,
        gender: this.gender === i18n.t('signup.male') ? '1' : '2',
        is_parent: this.parent
      }
      this.$store.dispatch('student/joinCourse', data)
    },
    showAll () {
      this.isShowAll = !this.isShowAll
      this.autoHeight = true
    },
    calcDate (timestamp) {
      const date = dateFormat(timestamp)
      return date
    },
    calcTime (timestamp) {
      const time = calcDuration(timestamp)
      return time
    },
    // previewFiles (event) {
    //   const file = event.target.files[0]
    //   this.firstname = file.name
    // },
    onFileChange (event) {
      var fileData = event.target.files[0]
      this.fileName = fileData
      this.url = URL.createObjectURL(fileData)
    },
    // changeActive1 () {
    //   this.student = this.$store.getters['student/getUserData']
    //   this.activeTab = false
    // },
    // changeActive2 () {
    //   if (this.anotherPerson === true) {
    //     this.student = []
    //     this.activeTab = true
    //   }
    // },
    close () {
      this.fullWidth = !this.fullWidth
      return this.fullWidth
    },
    submitForm () {
      if (this.check === false) {
        return false
      }
    },
    setUserData (student) {
      this.student = {
        ...student,
        bio: student.bio ? [...student.bio] : []
      }
    }
  },
  mounted () {
    const courseId = this.$route.params.id
    this.$store.dispatch('courses/coursePage', courseId).then(data => {
      this.courseData = data
    })
    let student = this.$store.getters['student/getUserData']

    if (student) {
      this.setUserData(student)
    } else {
      this.$store.dispatch('student/getUserData').then(() => {
        student = this.$store.getters['student/getUserData']
        this.setUserData(student)
      })
    }
  },
  computed: {
    // courseData () {
    //   console.log(this.$store.getters['courses/getCoursePage'])
    //   const courseInfo = this.$store.getters['courses/getCoursePage']
    //   return courseInfo || {}
    // },
    // student () {
    //   const { studentData } = this.$store.getters['student/profileData']
    //   console.log('student', studentData)
    //   return studentData || {}
    // },
    isAuthed () {
      return this.$store.getters['auth/isAuthenticated']
    },
    buttonTitleState () {
      return this.isAuthed ? 'الاشتراك في الدورة' : 'الاشتراك في الدورة'
    },
    sectionImgSrc () {
      if (this.courseData.section_id === 5) {
        return '/images/home-imgs/global.png'
      }
      return '/images/home-imgs/quran-icon2.png'
    },
    getRate () {
      const rate = this.courseData.rate.rate_average
      if (rate === 0) {
        return '5/5'
      }
      return rate.toFixed(1)
    },
    checkLanguage () {
      return this.$q.lang.rtl ? 'ar' : 'en'
    },
    countriesNamesOptions () {
      return countriesNames(this.checkLanguage)
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
  background-image: radial-gradient(#FAFAFA 0.7%, transparent 1%),
                    radial-gradient(#FAFAFA 0.8%, transparent 1%);
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
  box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 5%);
  height: 787px;
  overflow: hidden;
  position: relative;
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
.full-description{
  height: auto !important;
}
.show-more_description{
  position: absolute;
  bottom: 0px;
  left: 50%;
  margin-bottom: 15px;
}
.course-info__section{
  .course-info{
    @media (max-width:480px) {
      margin: 0px;
    }
    border-radius: 4px;
    box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 5%);
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
    mask-image: -webkit-gradient(linear, left top,
    left bottom, from(rgba(1,1,1,1)), to(rgba(0,0,0,0)));
}
.toggle-show1-no-gradient{
  mask-image: -webkit-gradient(linear, left top,
  left bottom, from(rgba(1,1,1,1)), to(rgba(1,1,1,1)));
}
.fileUpload {
  background: rgb(250, 234, 212);
  border: 1px solid rgb(230, 184, 125);
}
a.fileContainer {
    overflow: hidden;
    position: relative;
    display: inline-block;
    color: lightskyblue;
    cursor: pointer;
    text-decoration: underline;
}

a.fileContainer > input[type=file] {
    cursor: pointer;
    pointer-events: auto;
    filter: alpha(opacity=0);
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    text-align: right;
}
.q-field{
  &::v-deep{
    .q-field__inner{
      background-color: $grey-2;
      // border-radius: 7px;
    }
    .q-field__inner:focus{
      outline: none;
    }
  }
}
// .phone-field{
//   &::v-deep{
//     .q-field__inner{
//       border-radius: 7px 0px 0px 7px;
//       border-right: 0;
//       outline: none;
//     }

//   }
// }
// .select{
//   &::v-deep{
//     .q-field__inner{
//       border-radius: 0px 7px 7px 0px;
//     }
//     .q-select__dropdown-icon{
//       margin-top: -15px;
//       margin-right: 5px;
//     }
//   }
// }
  .phone-input .q-input {
    &::v-deep {
      .q-field__inner {
        border: solid 1px $grey-3;
        border-right: none;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
      }
      .q-field__inner:hover {
        border-color: $grey-5;
      }
      .q-field__prepend {
        padding-left: 12px;
      }
    }
  }

  .phone-select .q-select {
    &::v-deep {
      .q-field__inner {
        border: 1px solid  $grey-3;
        border-left-color: $grey-3;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
      }
      .q-field__control-container {
        padding-top: 5px;
      }
      .q-field__native {
        direction: rtl;
      }
      .q-field__append {
        padding-left: 5px;
      }
      .q-select__dropdown-icon{
        margin-right: 10px;
      }
    }
  }

  .phone:hover {
    &::v-deep {
      .q-select .q-field__inner {
        border-color: $grey-5;
        border-left-color: $grey-2;
      }
    }
  }
.join-form{
  position: relative;
  border-radius: 6px;
}
.white-form{
  border-radius: 0px 10px 10px 10px;
  box-shadow: 0px 0px 3px 0px #ccc;
  margin-bottom: 48px;
}
.tabs-list{
  padding: 0;
  margin-top: 0px;
  margin-bottom: 0px;
}
.tab1,.tab2{
  list-style: none;
  display: inline-block;
  background: $grey-1
}
.active-tab{
  background: #fff;
  border-radius: 8px 8px 0px 0px;
  box-shadow: 0px -2px 4px -1px #ccc;
}
.inactive-tab{
  background: $grey-2;
  border-radius: 8px 8px 0px 0px;
}
.attach-icon{
    overflow: hidden;
    position: relative;
    display: inline-block;
}
.attachment{
    cursor: pointer;
    // pointer-events: auto;
    // filter: alpha(opacity=0);
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    text-align: right;
}
.file-select > .select-button {
  padding: 1rem;

  color: white;
  background-color: #2EA169;

  border-radius: .3rem;

  text-align: center;
  font-weight: bold;
}

.file-select > input[type="file"] {
  display: none;
}
.imagePreviewWrapper {
    display: block;
    cursor: pointer;
    margin: 0 auto 0px;
    background-size: cover;
    background-position: center center;
}
</style>
