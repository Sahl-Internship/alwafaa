<template>
  <q-btn type="button" class="google-btn" @click="auth ('google')">
    <!-- <q-icon name="fab fa-google" size="md" class="google-icon" /> -->
    <i class="fab fa-google google-icon"></i>
    Signup With Google
  </q-btn>
</template>

<script>

export default {
  name: 'GoogleBtn',
  methods: {
    auth (network) {
      this.$hello(network).login({ scope: 'email' })
        .then((res) => {
          console.log(res)
          if (this.$hello.getAuthResponse(network) == null) {
            return
          }
          this.$hello(network).api('me')
            .then((res2) => {
              console.log(res2)
            })
        })
    }
  }
}
</script>

<style lang="scss" scoped>
// @import './src/css/font.scss';

  .google-btn {
    width: 85%;
    height: 45px;
    font-size: 20px;
    margin-top: 20px;
    background: #fff;
    box-shadow: 0px 0px 7px -1px rgba(0, 0, 0, 0.5);
    color: #000;

    .google-icon {
      margin-right: 10px;
      font-size: 25px;
      color: red;
    }
  }

  @media (max-width: 1439px) {
    .google-btn {
      font-size: $breakpointMD;

      .google-icon {
        font-size: $breakpointMD;
      }
    }
  }

  @media (max-width: 1023px) {
    .google-btn {
      font-size: $breakpointSM;
    }
  }

  @media (max-width: 860px)and(min-width: 700px) {
    .google-btn {
      font-size: $breakpointXS;

      .google-icon {
        font-size: $breakpointXS;
      }
    }
  }

  @media (max-width: 445px) {
    .google-btn {
      font-size: $breakpointXS;

      .google-icon {
        font-size: $breakpointXS;
      }
    }
  }

  @media (max-width: 360px) {
    .google-btn {
      font-size: $breakpointXXS;

      .google-icon {
        font-size: $breakpointXXS;
      }
    }
  }

  @media (max-width: 320px) {
    .google-icon {
      display: none;
    }
  }

  // @media (max-width: 599px) {
  //   .google-btn {
  //     font-size: $breakpointXS;
  //   }
  // }

  // @media (max-width: 400px) {
  //   .google-btn {
  //     font-size: $breakpointXXS;
  //   }

  //   .google-icon {
  //     display: none;
  //   }
  // }
</style>
