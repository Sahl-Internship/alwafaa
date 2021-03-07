<template>
  <div class="q-pa-xl q-gutter-md text-center main">
    <div class="row">
      <h3 class="col-12 title-1 text-grey-5">{{$t('iqraa.iqraaAcademy')}}</h3>
      <p class="col-12 title-2 q-mt-sm text-grey-5">{{$t('iqraa.learningWebsite')}}</p>
    </div>
    <div class="row justify-center text-center">
      <div class="col-xs-12 col-sm-12 col-md-3  q-mx-md q-my-md">
        <q-card class="my-card q-px-md q-py-sm first-card col" flat >
          <q-img
            src="/images/home-imgs/mosque.png" class="icon q-mt-xl"
          />

          <q-card-section class="row">
            <div class="text-h5 q-mt-xm q-mb-xs card-title-1 q-mr-auto q-ml-auto" style="width: 240px;">
              {{$t('iqraa.firstCardText1')}}</div>
            <div class="text-caption text-grey col-lg-10  q-mr-auto q-mb-lg q-ml-auto">
              {{$t('iqraa.firstCardText2')}}
            </div>
          </q-card-section>
        </q-card>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 q-my-md q-mx-md" >
      <q-card class="my-card q-px-md q-py-xs col flat"  flat>
        <q-img
          src="/images/home-imgs/book.png" class="icon q-mt-xl"
        />

        <q-card-section class="row">
          <div class="text-h5 q-mt-xs q-mb-xs card-title-1 col-lg-10   q-mr-auto q-ml-auto">{{$t('iqraa.secondCardText1')}}</div>
          <div class="text-caption text-grey col-lg-10 q-mb-lg  q-mr-auto q-ml-auto">
            {{$t('iqraa.secondCardText1')}}
          </div>
        </q-card-section>
      </q-card>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3  q-mx-md q-my-md">
      <q-card class="my-card q-px-md q-py-xs col" flat>
        <q-img
          src="/images/home-imgs/config.png" class="icon q-mt-xl"
        />

        <q-card-section class="text-center">
          <div class="text-h5 q-mt-xs q-mb-xs card-title-1 col-lg-10  q-mr-auto q-ml-auto column">{{$t('iqraa.thirdCardText1')}}</div>
          <div class="text-caption text-grey col-lg-10 q-mx-sm q-mb-lg column">
            {{$t('iqraa.thirdCardText2')}}
          </div>
        </q-card-section>
      </q-card>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'CoursesSection'
}
</script>

<style lang="scss" scoped>
.main{
  @media (max-width: 480px) ,(max-width: 767px){
    margin-top: 400px;
  }
}
.courses-sections {
  background-color: $grey-1;
  margin-top: 80px;
}
.title-1{
  font-size: 32px;
  font-weight: bold;
  @media(max-width:340px){
    font-size: 27px;
  }

}
.title-2{
  font-size: 24px;
  // font-weight: bold;
  @media (max-width:340px) ,(max-width: 480px) {
    font-size: 14px;
    line-height: 1.5;
  }
}
.card-title-1{
  font-size: 15px;
  line-height: 1.9;
  @media (max-width:340px) {
    font-size: 14px;
    line-height: 1.5;
  }
    @media (max-width:480px) {
    font-size: 15px;
    line-height: 1.5;
  }
  @media (max-width:767px) {
    font-size: 18px;
  }
}
.text-caption{
  @media(max-width: 340px){
    font-size: 10px;
    margin-top: 17px;
  }
  @media (max-width:480px) {
    margin-top: 15px;
    font-size: 12px;
  }
}
.icon{
  width: 150px;
  height: 150px;
}
.my-card {
  transition: box-shadow .3s;
}
.my-card:hover{
  box-sizing: border-box;
  border-left: 4px solid $green;
  border: 1px solid #eee;
  border-radius: 5px;
  box-shadow: 0 0 11px rgba(33,33,33,.2) !important;
  transform: scale(5px,5px);
}
</style>
