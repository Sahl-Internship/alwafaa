<template>
  <div class="col-sm-3 col-md-5 column justify-around second-section">
    <q-img
      alt="elearning-icon"
      src="~assets/auth-logo.png"
      class="self-center auth-page-img"
    />

    <div class="row justify-center">
      <div
        class="col-12 text-center text-white title"
        :class="{
          'text-h4': !$q.screen.lt.md,
          'text-h5': $q.screen.lt.md
        }"
      >
        {{$t(title)}}
      </div>

      <div class="col-12 text-h6 text-center text-white q-mt-md text">
        {{$t(text)}}
      </div>

      <q-btn
        rounded
        type='button'
        :label='$t(buttonLabel)'
        color="white"
        text-color="grey-5"
        :class="{
          'col-5': !$q.screen.lt.md,
          'col-10': $q.screen.lt.md,
          'q-mt-xl': true
        }"
        :size="$q.screen.lt.md? 'md' : 'lg'"
        :to='goTo'
      />
    </div>
  </div>
</template>

<script>
export default {
  name: 'SecondSection',
  computed: {
    title () {
      return this.$route.name === 'login' ? 'noAccount' : 'alreadyHaveAccount'
    },
    text () {
      return this.$route.name === 'login' ? 'completeYourInfo' : 'signupDecisionText'
    },
    buttonLabel () {
      return this.$route.name === 'login' ? 'createAccount' : 'loginTitle'
    },
    goTo () {
      return this.$route.name === 'login' ? '/auth/signup' : '/auth/login'
    }
  }
}
</script>

<style lang="scss" scoped>
.second-section {
  background-image: linear-gradient($primary, $green);

  .auth-page-img {
    width: 40%;
  }

  @media (max-width: 1024px){
    .text {
      font-size: 15px;
    }
  }

  @media (max-width: 850px){
    .title {
      font-size: 17px;
      font-weight: bold;
    }

    .text {
      font-size: 12px;
    }
  }

}
</style>
