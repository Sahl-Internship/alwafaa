<template>
  <q-layout
    view="hHh Lpr fFf"
    :class="{
      row: true,
      reverse: reverseRow,
      'justify-center': $q.screen.lt.sm
    }"
  >
    <div
      v-if="!$q.screen.lt.sm"
      class="col-xs-1 col-sm-3 col-md-5 login-section"
    >
        <!-- my responsive class="col-5 login-section" -->
        <!-- class="col-sm-3 col-md-4 col-lg-5 login-section" -->
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
    <q-page-container class="col-xs-12 col-sm-9 col-md-7">
      <!-- my responsive  <q-page-container class="col-xs-12 col-sm-7 col-md-7 col-lg-7"> -->
      <router-view />
    </q-page-container>
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
      goTo: '/auth/login'
    }
  },
  computed: {
    reverseRow () {
      const { name } = this.$route
      return name === 'login'
    }
  },
  mounted () {
    if (this.$route.name === 'login') {
      this.title = 'noAccount'
      this.text = 'completeYourInfo'
      this.buttonTitle = 'createAccount'
      this.goTo = '/auth/signup'
    }
  }
}
</script>

<style lang="scss" scoped>
  .auth-page-img {
    width: 40%;
    top: 50px;
  }

  .login-section {
    background-image: linear-gradient($primary, $green);
    @media (max-width: 600px) {
      display: none;
    }
  }
  .no-account{
    text-align: center;
    color: #fff;
    margin: 100px 0px 0px;
    height: 0px;
    line-height: 3.5;
    font-weight: bold;
    @media (max-width: 767px),(max-width:992px){
      font-size: 25px;
    }
  }
  .complete-info{
    font-size: 17px;
    height: 0px;
    line-height: 9;
    margin:25px 0px 70px;
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
    top: 100px;
    @media (max-width: 767px),(max-width: 992px){
      top: 50px;
      font-size: 14px;
    }
}
</style>
