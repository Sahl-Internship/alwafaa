<template>
  <div class="q-pa-none col-12">

    <q-img
      src="~assets/home-imgs/header.png"
      class="img"
    >
      <div class="search-section justify-around absolute-center">
        <h4 class="text-grey-3"> إبدأ رحلتك التعليمية ,تعلم اليوم, لتقود الغد </h4>
        <h6 class="text-grey-3">235 كورس في اللغة العربيةو تحفيظ القرآن الكريم يتم تدريسها من قبل خبراء</h6>
        <q-input outlined bottom-slots v-model="text" bg-color="white" counter maxlength="12" :dense="dense">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
      </div>
    </q-img>
  </div>
</template>

<script>
export default {
  data () {
    return {
      slide: 1,
      autoplay: true
    }
  }
}
</script>
<style lang='scss' scoped>
.img{
  background-size: cover;
}
</style>
