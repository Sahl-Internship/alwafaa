<template>
  <!-- <div class="q-pt-xl q-px-xl academy-info"> -->
  <div
    class="row justify-around items-center q-py-xl q-px-sm wrap academy-info"
    :class="!$q.screen.lt.xl ? 'section-height' : ''"
  >
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 text-center first card">
      <div class="back-img">
          <img src="~assets/home-imgs/info-course.png" class="icon"/>
        <h3 class="text-white">235</h3>
        <h6 class="text-white q-mt-none q-pt-none column">{{$t('academyInfo.course')}}</h6>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 text-center second card">
      <div class="back-img">
          <img src="~assets/home-imgs/info-student.png"  class="icon"/>
        <h3 class="text-white">61.8</h3>
        <h6 class="text-white">{{$t('academyInfo.student')}}</h6>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 text-center third card">
          <div class="back-img">
            <img src="~assets/home-imgs/info-player.png" class="icon"/>
            <h3 class="text-white">14.1</h3>
            <h6 class="text-white">{{$t('academyInfo.lecture')}}</h6>
            </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 text-center fourth card">
      <div class="back-img">
          <img src="~assets/home-imgs/info-timer.png" class="icon"/>
        <h3 class="text-white">17.8</h3>
        <h6 class="text-white last-text">{{$t('academyInfo.time')}}</h6>
      </div>
    </div>
  </div>
  <!-- </div> -->
</template>

<script>

export default {
  name: 'AcademyInfoSection'
}
</script>

<style lang="scss" scoped>
.academy-info {
  background-image: linear-gradient($primary,$green);
  height: 400px;
  .card{
    position: relative;
    &:before{
      content: "";
      width: 2px;
      height: 100%;
      position: absolute;
      left: 0;
      background: #fff;
    }
  }
  .icon-container{
    position: relative;
    margin-bottom: 10px;
    border-left: 2px solid $white;
    @media (max-width: 600px) {
      border-left: none;
    }
  }

  .first{
    .back-img::before{
      background-position: center;
      content: "";
      background-image: url('~assets/home-imgs/info-course2.png');
      background-size: auto 100%;
      position: absolute;
      background-repeat: no-repeat;
      top: 0px;
      right: 0px;
      bottom: 0px;
      left: 0px;
      opacity: 0.04;
      @media(max-width: 480px),(max-width: 767px),(max-width: 992px){
        background-size: auto 70%;
      }
    }
    &:before{
      width: 0;
    }
  }
  .second{
    .back-img::before{
      background-position: center;
      content: "";
      background-image: url('~assets/home-imgs/info-student2.png');
      background-size: auto 100%;
      position: absolute;
      background-repeat: no-repeat;
      top: 0px;
      right: 0px;
      bottom: 0px;
      left: 0px;
      opacity: 0.04;
      @media(max-width: 480px),(max-width: 767px),(max-width: 992px){
        background-size: auto 70%;
      }
    }
  }
  .third{

    .back-img::before{
      background-position: center;
      content: "";
      background-image: url('~assets/home-imgs/info-player2.png');
      background-size: auto 100%;
      position: absolute;
      background-repeat: no-repeat;
      top: 0px;
      right: 0px;
      bottom: 0px;
      left: 0px;
      opacity: 0.04;
      @media(max-width: 480px),(max-width: 767px),(max-width: 992px){
        background-size: auto 70%;
      }
    }
      &::before{
      @media (max-width: 992px),(max-width: 767px){
          width: 0;
      }}
  }
  .fourth{
    .back-img::before{
      background-position: center;
      content: "";
      background-image: url('~assets/home-imgs/info-timer2.png');
      background-size: auto 100%;
      position: absolute;
      background-repeat: no-repeat;
      top: 0px;
      right: 0px;
      bottom: 0px;
      left: 0px;
      opacity: 0.04;
      @media(max-width: 480px),(max-width: 767px),(max-width: 992px){
        background-size: auto 70%;
      }
    }
  }
  .icon{
    position: absolute;
    top: 55px;
    left: 80px;
    width: 35px;
    height: 35px;
    @media (max-width: 340px),(max-width: 480px){
      top: 45px;
      width: 25px;
      height: 25px;
      left: 25px;
    }
    // @media (max-width: 767px){
    //   left: 25%;
    // }
  }
  &.section-height {
    height: 350px;
  }
  .info-title {
    color: $green;
    margin: 20px 0 10px;
    text-align: center;
  }
}
h3{
  @media (max-width: 340px),(max-width: 480px){
    font-size: 35px;
  }
}
h6{
  margin-top: -40px;
    @media (max-width: 340px),(max-width: 480px){
    font-size: 14px;
  }
}
.last-text{
  margin-top: -40px;
  margin-left: 70px;
  @media (max-width: 340px),(max-width: 480px){
       margin-left: 35px;
  }
}
</style>
