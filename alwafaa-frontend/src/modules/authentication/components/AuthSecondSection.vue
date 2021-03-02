<template>
  <div
    class="col-sm-3 col-md-5 column justify-around second-section"
    :class="{
      'img-flip': checkFlip
    }"
  >
    <q-img
      alt="elearning-icon"
      src="/images/auth-logo.png"
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
        {{$t(values.title)}}
      </div>

      <div class="col-12 text-h6 text-center text-white q-mt-md text">
        {{$t(values.text)}}
      </div>

      <g-btn
        type='button'
        :label="values.buttonLabel"
        color="white"
        :width="!$q.screen.lt.md ? 'col-5' : 'col-10'"
        :margin="['q-mt-xl']"
        :to='values.goToURL'
      />
    </div>
  </div>
</template>

<script>
export default {
  name: 'AuthSecondSection',
  computed: {
    values () {
      return this.$route.name === 'signup'
        ? {
          title: 'secondSection.alreadyHaveAccount',
          text: 'secondSection.haveAccountLogin',
          buttonLabel: 'secondSection.login',
          goToURL: '/auth/login'
        }
        : {
          title: 'secondSection.noAccount',
          text: 'secondSection.completeYourInfo',
          buttonLabel: 'secondSection.createAccount',
          goToURL: '/auth/signup'
        }
    },
    checkFlip () {
      return this.$route.name !== 'signup'
    }
  }
}
</script>

<style lang="scss" scoped>
.second-section {
  background-image: url('/images/second-section-auth.png'), linear-gradient($primary, $green);
  background-size: cover;

  // &.img-flip {
  //   transform: scaleX(-1);
  // }

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
