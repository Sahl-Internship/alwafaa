/* eslint-disable vue/valid-v-model */
<template>
  <div class="row col-11 teacher">
    <div class="text-h6 col-8 q-mt-xl q-mb-md">تقييمات </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-8 about-teacher bg-grey-1 q-py-lg">
      <div class="row col-12 comment-card  q-py-md q-px-lg q-mx-auto q-mb-md">
        <div class="col-12">
          <div class="text-center">
            <star-rating
              :increment=0.5
              :rating="rate"
              :star-size="$q.screen.lt.md ? 20 : 30"
              :padding="$q.screen.lt.md ? 3 : 5"
              :active-color="['#FFC003']"
              :show-rating=false
              :rtl=true
              class="justify-center"
              @rating-selected ="setRating"
            ></star-rating>
            <div
              class="text-caption text-grey-4 q-ml-md q-mt-sm"
            >ما تقييمك لهذه الدورة؟
            </div>
          </div>
          <q-input
            outlined
            color="grey-2"
            v-model="review"
            label="رأيك في الدورة"
            bg-color="grey-1"
            maxlength="300"
            class="col-xs-9 col-sm-5 col-md-5 col-lg-5 column q-mt-lg q-mx-auto input-field "
          >
          </q-input>
          <div
            class="text-h6 text-center q-mt-md"
            style="text-decoration:underline;cursor: pointer;"
            @click="sendReview"
            >ارسال التقييم
          </div>
        </div>
      </div>
      <div class="text-h6 col-8 q-mt-sm q-mb-md q-ml-lg student-comments">ملاحظات الطلاب للدورة</div>

      <div
        v-for="x in 3"
        :key='x'
        class="row col-10 comment-card  q-py-md q-px-lg q-mx-auto q-mb-sm"
      >
        <div
          class="col-1 q-ml-md q-mr-sm"
        >
          <img
            src="images/home-imgs/omar.jpg"
            style="width:45px;height:45px;border-radius:50%;margin-top:4px"
          >
        </div>
        <div
          class="col-10"
        >
          <div
            class="text-h6 row no-wrap"
          >
            محمد سليمان
          </div>
          <div
            class="row no-wrap"
          >
            <star-rating
              read-only
              :increment=0.5
              :rating=4.5
              :star-size="$q.screen.lt.md ? 13 : 20"
              :padding="$q.screen.lt.md ? 3 : 5"
              :active-color="['#FFC003']"
              :show-rating=false
              :rtl=true
            ></star-rating>
            <div
              class="text-subtitle1 text-grey-3 q-ml-md"
            >
              12 يناير 2021
            </div>
          </div>
          <div
            class="text-body1"
          >
            دورة رائعة , الكريم من المعلومات الجديدة المفيدة
          </div>
          <div
            class="row q-mt-md"
          >
            <div
              class="arrow q-mr-xs"
            >
              <span
                class="material-icons"
                :class="{'like': thumpUp}"
                style="font-size:25px;cursor: pointer;"
                @click="up"
              >
                thumb_up_off_alt
              </span>
            </div>
            <div
              class="arrow"
            >
              <span
                class="material-icons"
                :class="{'like': thumpDown}"
                style="font-size:25px;cursor: pointer;"
                @click="down"
              >
                thumb_down_off_alt
              </span>
            </div>
          </div>
        </div>
      </div>
      <div
        class="text-body1 col-10 text-center text-bold comment-card q-py-md q-mx-auto"
        @click="showComments"
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
</template>
<script>
import StarRating from 'vue-star-rating'
export default {
  components: { StarRating },
  data () {
    return {
      isShowComments: false,
      shownComments: 3,
      thumpUp: false,
      thumpDown: false,
      rate: 0,
      rank: 0,
      review: ''
    }
  },
  computed: {
    isAuthed () {
      return this.$store.getters['auth/isAuthenticated']
    },
    userToken () {
      return this.$store.getters['auth/getToken']
    }
  },
  methods: {
    setRating (rating) {
      this.rate = rating
    },
    up () {
      this.rank++
      this.thumpUp = true
      this.thumpDown = false
    },
    down () {
      this.rank--
      this.thumpDown = true
      this.thumpUp = false
    },
    showComments () {
      if (this.shownComments === 12) {
        return false
      } else {
        this.shownComments += 3
      }
    },
    sendReview () {
      const courseId = this.$route.params.id
      const comment = {
        rate: this.rate,
        review: this.review,
        courseId
      }
      this.$store.dispatch('courses/courseReview', comment)
    }
  }
}
</script>
<style lang='scss' scoped>
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
.teacher{
  .about-teacher{
    border-radius: 8px;
    box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 5%);
  }
  .teacher-img{
    width: 120px;
    height: 120px;
    border: 5px solid #fff;
    border-radius: 50%;
    @media (max-width:480px) {
      width: 85px;
      height: 85px;
    }
  }
  .teacher-classes{
    @media (max-width:480px) {
      width: 235px;
      margin-left: 23px;
    }
  }
}
.q-field{
  &::v-deep{
    .q-field__control {
      height: 80px;
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
.course-classes__timeline{
  border-radius: 5px;
}

.student-comments{
  position: relative;;
  &::after{
    content: '';
    width: 70%;
    height: 1px;
    background: $grey-2;
    position: absolute;
    margin-left: 10px;
    top: 20px;
  }
}
.comment-card{
  width: 95%;
  border-radius: 5px;
  background: #fff;
  box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 5%);
  .arrow{
    text-align: center;
    border: 2px solid $grey-2;
    border-radius: 50%;
    margin-right: 8px;
    height: 35px;
    width: 35px;
    line-height: 2;
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
.like{
  color: $primary
}
</style>
