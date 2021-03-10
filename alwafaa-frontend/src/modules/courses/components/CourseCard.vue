<template>
  <q-card class="course-card">
    <q-img src="/images/home-imgs/alorefy.jpg">
      <div
        class="column justify-between no-wrap fit"
        :class="$q.screen.lt.md ? 'cover-text' : ''"
      >

        <div :class="$q.screen.lt.sm ? 'row' : 'row q-gutter-y-xs'">
          <div class="col-12 row items-center">
            <img
              src="/images/home-imgs/person.png"
              :class="{
                'icon-lg': !$q.screen.lt.sm,
                'icon-sm': $q.screen.lt.sm
              }"
            />
            <div
              :class="{
                'text-subtitle2': !$q.screen.lt.sm,
                'text-caption': $q.screen.lt.sm,
                'q-ml-sm': true
              }"
            >د/محمد العريفي</div>
          </div>

          <div class="col-12 row items-center">
            <img
              src="/images/Path 8205 22.png"
              :class="{
                'icon-lg': !$q.screen.lt.sm,
                'icon-sm': $q.screen.lt.sm
              }"
            />
            <div
              :class="{
                'text-subtitle2': !$q.screen.lt.sm,
                'text-caption': $q.screen.lt.sm,
                'q-ml-sm': true
              }"
            >اللغة العربية</div>
          </div>
        </div>

        <div class="row">
          <div
            class="text-grey-5 bg-green q-px-sm rounded-borders"
            :class="{
              'text-subtitle2 q-py-xs': !$q.screen.lt.sm,
              'text-caption': $q.screen.lt.sm,
            }"
          >
            لم تبدء
          </div>
        </div>

      </div>
    </q-img>

    <q-card-section :class="$q.screen.lt.md ? 'q-px-xs q-py-md' : 'q-pa-xl'">
      <div
        class="text-grey-5 text-center"
        :class="{
          'text-h6 text-weight-bold': !$q.screen.lt.md,
          'text-subtitle2': $q.screen.lt.md,
        }"
      >
        استخدام الاسماء الخمسة في حالات الاعراب الثلاثة
      </div>

      <div class="row justify-center q-mt-md">
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
    </q-card-section>

    <q-card-section
      class="row justify-between items-center rounded-borders bottom-section"
      :class="$q.screen.lt.md ? 'bottom-section-sm' : 'q-px-lg'"
    >
      <div class="col-2 row items-center no-wrap">
        <img
          src="/images/home-imgs/viewed.png"
          :class="{
            'icon-lg': !$q.screen.lt.sm,
            'icon-sm': $q.screen.lt.sm
          }"
        />
        <div
          :class="{
            'text-subtitle1 q-ml-sm': !$q.screen.lt.md,
            'text-caption q-ml-xs': $q.screen.lt.md,
            'text-grey-4': true
          }"
        >7</div>
      </div>

      <div
        class="col-5 row items-center no-wrap"
        :class="isAuthenticated ? 'justify-center' : 'justify-end'"
      >
        <img
          src="/images/home-imgs/duration.png"
          :class="{
            'icon-lg': !$q.screen.lt.sm,
            'icon-sm': $q.screen.lt.sm
          }"
        />
        <div
          :class="{
            'text-subtitle1 q-ml-sm': !$q.screen.lt.md,
            'text-caption q-ml-xs': $q.screen.lt.md,
            'text-grey-4': true
          }"
        >05:30:00</div>
      </div>

      <div
        v-if="isAuthenticated"
        class="col-3 row justify-end items-center no-wrap"
      >
        <img
          src="/images/Path 8197.png"
          :class="{
            'icon-lg': !$q.screen.lt.sm,
            'icon-sm': $q.screen.lt.sm
          }"
        />
        <div
          :class="{
            'text-subtitle1 q-ml-sm': !$q.screen.lt.md,
            'text-caption q-ml-xs': $q.screen.lt.md,
            'text-grey-4': true
          }"
        >253</div>
      </div>
    </q-card-section>
  </q-card>
</template>

<script>
import StarRating from 'vue-star-rating'

export default {
  components: { StarRating },
  computed: {
    isAuthenticated () {
      return this.$store.getters['auth/isAuthenticated']
    }
  }
}
</script>

<style lang="scss" scoped>
.course-card {
  width: 31.3%;
  min-width: 155px;

  .icon-lg {
    width: 15px;
    height: 15px;
  }

  .icon-sm {
    width: 10px;
    height: 10px;
  }
}

.q-img__content > div {
  &.cover-text {
    padding-top: 5px;
    padding-bottom: 5px;
  }
}

.bottom-section {
  border-top: solid 1.5px $grey-1;
}

.q-card__section--vert {
  &.bottom-section-sm {
    padding-left: 5px;
    padding-right: 5px;
  }
}

.q-card > div:not(:first-child),
.q-card > img:not(:first-child) {
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
}
</style>
