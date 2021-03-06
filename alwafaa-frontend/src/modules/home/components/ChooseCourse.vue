<template>
<div class=" row choose-course items-center q-pa-xl q-mb-xl" >
    <div class=" col-xs-12 col-sm-6 col-md-6 col-lg-8 " >
    <div class="q-mb-lg q-my-xs text-center">
    <img src="~assets/home-imgs/block3.png" class="choose-img"/>
    </div>
    </div>
    <div class=" col-xs-12 col-sm-6 col-md-6 col-lg-4 q-px-lg ">
    <h4 class="">{{$t('chooseCourse.howtoChoose')}}</h4>
    <div class="choose-description">
    <p class="text-grey-4 choose-title">- {{$t('chooseCourse.text1')}}</p>
    <p class="text-grey-4 choose-title-2">- {{$t('chooseCourse.text2')}}</p>
    </div>
    <g-btn
    :label="$t('chooseCourse.availableCourses')"
    class="col-3 q-px-lg q-mt-lg"
    />
    </div>
</div>
</template>
<style lang='scss' scoped>
.choose-course {
  background: $grey-1;
  // height: 700px;
  h4{
  @media (max-width: 767px) {
    font-size: 26px;
  }
  @media (max-width: 480px){
    font-size: 22px;
  }
  @media (max-width: 340px){
    font-size: 23px;
  }
}
.choose-description{
  width: 399px;
  @media (max-width: 340px) ,(max-width:480px){
    width: auto;
  }
}
.choose-title-2{
  margin-top: -10px;
  line-height: 1.8;
}
.choose-title{
  margin-top: -30px;
  line-height: 1.8;
  @media (max-width: 767px){
    font-size: 16px;
  }
  @media (max-width: 480px){
    margin-top: -25px;
    font-size: 14px;
  }
  @media (max-width: 340px){
    font-size: 14px;
    line-height: 1.4;
  }
}
  .choose-img{
    width: auto;
    max-height: 500px;
    @media (max-width: 992px) {
      height: 360px;
    }
    @media (max-width: 767px) {
      height: 360px;
    }
    @media (max-width: 480px){
      height: 260px;
    }
    @media (max-width: 340px){
      height: 220px;
    }
  }
}
</style>
