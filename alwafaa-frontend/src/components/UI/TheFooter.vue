<template>
  <div class="footer q-pa-xl">
    <div class="row justify-center items-center q-mb-xl ">
    <img src="~assets/home-imgs/footer-img.png" class="footer-img">

    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-white text-right q-my-sm q-pr-lg contact phone">
        <i class="fas fa-phone-alt phone-icon text-white q-mr-md"></i>
        <p class="phone-no">  9542523 - 966+</p>

      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 contact q-my-sm">
        <i class="fas fa-envelope text-white mail-icon q-mr-md"></i>
        <p class="email text-white">Info@Iqraa.com</p>
      </div>
      <q-separator size='2px' class="col-10 q-mr-auto q-ml-auto" spaced="lg" color='#363840'/>
    </div>
    <div class=" row links-container text-center">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 q-mr-auto q-ml-auto">
        <ul>
          <!-- <li class="links-list q-mx-lg"><router-link to="/">كن من فريق العمل</router-link></li> -->
          <li class="links-list q-mx-lg"><router-link to="/">{{$t('footer.beWithUs')}}</router-link></li>
          <li class="links-list q-mx-lg"><router-link to="/">{{$t('footer.addScholarship')}}</router-link></li>
          <li class="links-list q-mx-lg"><router-link to="/">{{$t('footer.Contests_grants')}} </router-link></li>
          <li class="links-list q-mx-lg"><router-link to="/">{{$t("footer.suggest")}}</router-link></li>
          <li class="links-list q-mx-lg"><router-link to="/">{{$t('footer.terms')}}</router-link></li>
        </ul>
      </div>
    </div>
    <div class="column text-center q-mt-lg">
      <ul class="q-mr-lg">
        <li class="q-mx-sm  q-my-md icon">
          <i class="fab fa-youtube"></i>
        </li>
        <li class="q-mx-sm q-my-md icon">
          <i class="fab fa-linkedin-in" ></i>
        </li>
        <li class="q-mx-sm q-my-md icon">
          <i class="fab fa-twitter"></i>
        </li>
        <li class="q-mx-sm q-my-md icon">
          <i class="fab fa-facebook-f" ></i>
        </li>
      </ul>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.footer {
  @media (max-width: 480px){
    height: 640px;
  }
  background: $grey-5;
  // margin-top: 50px;
  position: relative;
  .footer-img{
    height: 120px;
    width: 120px;
    z-index: 100;
  }
  .contact{
    @media(max-width:340px) ,(max-width: 480px){
      text-align: center;
    }
  }
  .phone{
    @media (max-width:340px),(max-width:480px) {
      padding-right: 0;
    }
  }
  p{
    display: inline;
  }
  .links-container{
      @media(max-width:340px) ,(max-width: 480px){
        text-align: left !important;
      }
    }
  ul{
    list-style: none;
    .links-list{
      display: inline-block;
    }

    .icon{
      display: inline-block;
      background: #fff;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      text-align: center;
      margin-top: -15px !important;
      @media (max-width: 340px) ,(max-width: 480px) {
        width: 30px;
        height: 30px;
      }
      i{
        color: $grey-5;
        line-height: 1.9;
        font-size: 20px;
        @media (max-width: 340px) ,(max-width: 480px) {
          font-size: 15px;
          line-height: 1.8;
        }
      }
    }
  }
  a{
    text-decoration: none;
    color: $grey-3;
    font-size: 14px;
          @media (max-width: 480px), (max-width: 340px) {
        line-height: 2.1;
      }
  }
  .copy-rights {
    color: #fff;
    text-align: center;
  }
  // .links-list{
  //   @media (max-width: 1024px){
  //     margin: 20px 60px;
  //   }
  // }
}
</style>
