<template>
  <q-card style="width: 31.34%; minWidth: 330px">
    <q-img
      src="/images/home-imgs/alorefy.jpg"
    >
      <div class="column justify-between fit">
        <div class="row q-gutter-y-xs">
          <div class="col-12 row items-center">
            <img src="/images/home-imgs/person.png" width="15px" height="15px" />
            <div class="text-subtitle2 q-ml-sm">د/محمد العريفي</div>
          </div>

          <div class="col-12 row items-center">
            <img src="/images/Path 8205 22.png" width="15px" height="15px" />
            <div class="text-subtitle2 q-ml-sm">اللغة العربية</div>
          </div>
        </div>

        <div class="row">
          <div class="text-subtitle2 text-grey-5 bg-green q-px-sm q-py-xs rounded-borders">
            لم تبدء
          </div>
        </div>
      </div>
    </q-img>

    <q-card-section class="q-pa-xl">
      <div class="text-h6 text-grey-5 text-center text-weight-bold">
        استخدام الاسماء الخمسة في حالات الاعراب الثلاثة
      </div>

      <div class="row justify-center q-mt-md">
        <div class="text-subtitle1 text-grey-4">4.5</div>

        <star-rating
          :increment=0.5
          :rating=4.5
          read-only
          :star-size=20
          :padding=5
          :active-color="['#e49d1a']"
          :show-rating=false
          :rtl=true
        ></star-rating>

        <div class="text-subtitle1 text-grey-4 q-ml-sm">(454)</div>
      </div>
    </q-card-section>

    <q-card-section class="row justify-between items-center rounded-borders bottom-section">
      <div class="col-2 row items-center">
        <img src="/images/home-imgs/viewed.png" width="15px" height="15px" />
        <div class="text-subtitle1 text-grey-4 q-ml-sm">7</div>
      </div>

      <div class="col-4 row items-center">
        <img src="/images/home-imgs/duration.png" width="15px" height="15px" />
        <div class="text-subtitle1 text-grey-4 q-ml-sm">05:30:00</div>
      </div>

      <div v-if="isAuthenticated" class="col-2 row items-center">
        <img src="/images/Path 8197.png" width="17px" height="15px" />
        <div class="text-subtitle1 text-grey-4 q-ml-sm">253</div>
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
.bottom-section {
  border-top: solid 1.5px $grey-1;
}

.q-card > div:not(:first-child),
.q-card > img:not(:first-child) {
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
}
</style>
