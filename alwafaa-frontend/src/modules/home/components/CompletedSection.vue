<template>
    <div class=" row completed  q-pa-sl q-mx-md q-mb-lg reverse-wrap items-center">
        <div class=" col-xs-12 col-sm-6 col-md-6 col-lg-6 q-px-xl" >
        <h4 class="">- {{$t('completedSection.title')}}</h4>
        <div class="completed-description">
                <p class="text-grey-4 completed-title-1">- {{$t('completedSection.text1')}}</p>
        <p class="text-grey-4 completed-title-2">- {{$t('completedSection.text2')}}</p>
        <p class="text-grey-4 completed-title-3">- {{$t('completedSection.text3')}}</p>
        </div>
        </div>
        <div class=" col-xs-12 col-sm-6 col-md-6 col-lg-6 q-my-xl">
        <div class="text-center">
        <img src="/images/home-imgs/block2.png" class="completed-img"/>
        </div>
        </div>
    </div>
</template>
<style lang='scss' scoped>
.completed {
  h4{
    font-size: 20px;
  @media (max-width: 767px) {
    font-size: 17px;
  }
  @media (max-width: 480px){
    font-size: 14px;
  }
  @media (max-width: 340px){
    font-size: 14px;
  }
}
p{
  margin: 0;
  line-height: 1.8;
  @media (max-width: 767px){
    font-size: 16px;
  }
  @media (max-width: 480px){
    font-size: 14px;
  }
  @media (max-width: 340px){
    font-size: 14px;
  }
}
.completed-description{
  width:385px;
  margin-top: -18px;
    @media (max-width: 340px) ,(max-width:480px){
    width: 225px;
  }
}
  .completed-img{
    max-height: 500px;
    width: auto;
    @media (max-width: 992px) {
      max-height: 360px;
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
