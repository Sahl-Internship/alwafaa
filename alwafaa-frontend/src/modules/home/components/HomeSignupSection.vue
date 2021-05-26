<template>
  <div class="row q-px-xl q-py-xl q-my-xl reverse-wrap">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 q-mt-xl" >
      <h4 class='q-pb-md'>{{$t('createAccount.createAccountTitle')}} </h4>
      <p class="text-grey-4">{{$t('createAccount.firstText')}}</p>
      <p class="text-grey-4"> {{$t('createAccount.secondText')}}</p>
      <p class="text-grey-4">-{{$t('createAccount.thirdText')}} <router-link to="/auth/login"> {{$t('createAccount.login')}}  </router-link></p>
      <g-btn
        :label="$t('homeCover.signupFree')"
        class="col-3 q-px-md q-my-lg"
        to='/auth/signup'
      />
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 img-container" >
      <img src="/images/home-imgs/create-account.png" class="create-img">
        <img src="/images/home-imgs/block4.png" class="rol-img" :class="{'flip':!checkDirection}"/>
    </div>
  </div>
</template>

<script>

export default {
  name: 'CoursesSection',
  computed: {
    checkDirection () {
      return this.$q.lang.rtl
    }
  }
}
</script>

<style lang="scss" scoped>
.main{
  @media (max-width: 340px),(max-width: 480px){
    flex-direction: row-reverse;
  }
}
.img-container{
  position: relative;
  .create-img{
    max-width: 100%;
    height: auto;
  }
  .rol-img{
    position: absolute;
    background: transparent;
    bottom: 0px;
    left: -83px;
    margin-bottom: -120px;
    height: 200px;
    width: auto;
    @media (max-width: 340px) , (max-width: 480px){
      display: none;
    }
  }
}

h4,h6{
  height: 1px;
}
h4{
  @media (max-width: 767px) {
    font-size: 26px;
  }
  @media (max-width: 480px){
    font-size: 26px;
  }
  @media (max-width: 340px){
    font-size: 23px;
  }
}
p{
  margin: 0;
  @media (max-width: 767px){
    font-size: 16px;
  }
  @media (max-width: 480px){
    font-size: 16px;
  }
  @media (max-width: 340px){
    font-size: 14px;
    line-height: 1.3;
  }
}
a{
  color: $primary;
}
.flip{
 margin-bottom: -100px !important;
 left: 430px !important;
 height: 170px !important;
}
</style>
