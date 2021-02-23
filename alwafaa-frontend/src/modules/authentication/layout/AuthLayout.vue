<template>
  <q-layout view="hHh Lpr fFf" class="row justify-center items-center layout" :class="{'reverse':loginRoute}">
    <div
      class="col-5 column justify-center right-section"
      :class="{
        'right-section': $q.screen.lt.sm,
      }"
    >
      <div class="row justify-center">
        <q-img
          alt="elearning-icon"
          src="~assets/auth-logo.png"
          class="self-center auth-page-img col-12"
        />
        <h4
          class="no-account col-12">
          {{$t(title)}}
        </h4>
        <h6 class="complete-info col-12">{{$t(text)}}</h6>

        <q-btn type='button'
          class='create-btn col-12'
          :label='$t(buttonTitle)'
          :to='goTo'
        />

      </div>
    </div>
    <div class="col-xs-9 col-sm-7 col-md-7 col-lg-7 left-section" >
      <slot></slot>
    </div>
  </q-layout>
</template>

<script>

export default {
  name: 'AuthLayout',
  data () {
    return {
      title: 'alreadyHaveAccount',
      text: 'signupDecisionText',
      buttonTitle: 'loginTitle',
      goTo: '/login'
    }
  },
  computed: {
    loginRoute () {
      return this.$route.name === 'login'
    }
  },
  mounted () {
    if (this.$route.name === 'login') {
      this.title = 'noAccount'
      this.text = 'completeYourInfo'
      this.buttonTitle = 'createAccount'
      this.goTo = '/signup'
    }
  }
}
</script>

<style lang="scss" scoped>
.layout{
  background-color: #fff;
  .auth-page-img {
    width: 40%;
    top: -80px;
  }

  .right-section {
    background-image: linear-gradient($primary, $green);
    height: calc(100vh );
    @media screen and (max-width: 600px) {
      display: none;
    }
  }
  .no-account{
    text-align: center;
    color: #fff;
    margin: 25px 0px;
    height: 0px;
    font-weight: bold;
    @media (max-width: 767px),(max-width:992px){
      font-size: 25px;
    }
  }
  .complete-info{
    font-size: 17px;
    height: 0px;
    line-height: 3.5;
    margin:10px 0px 30px;
    text-align: center;
    color: #fff;
    @media (max-width: 767px),(max-width:992px){
      font-size: 14px;
    }
  }
  .create-btn{
    font-size: 20px;
    background-color: #fff;
    border-radius: 30px;
    color:$dark;
    width: 46%;
    margin: 0px 27%;
    text-align: center;
    height: 45px;
    top: 60px;
    @media (max-width: 767px),(max-width: 992px){
      top: 50px;
      font-size: 14px;
    }
  }
}
</style>
