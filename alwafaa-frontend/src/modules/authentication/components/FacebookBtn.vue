<template>
  <q-btn type="button" class="facebook-btn" @click="auth ('facebook')">
    <i class="fab fa-facebook-f facebook-icon"></i>
    Signup With Facebook
  </q-btn>
</template>

<script>

export default {
  name: 'FacebookBtn',
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
  .facebook-btn {
    width: 85%;
    height: 45px;
    background-color: #1a75ff;
    color: #fff;
    font-size: 20px;
    margin-top: 30px;

    .facebook-icon {
      margin-right: 10px;
      font-size: 25px;
    }
  }

  @media (max-width: 1439px) {
    .facebook-btn {
      font-size: $breakpointMD;

      .facebook-icon {
        font-size: $breakpointMD;
      }
    }
  }

  @media (max-width: 1023px) {
    .facebook-btn {
      font-size: $breakpointSM;

      .facebook-icon {
        font-size: $breakpointSM;
      }
    }
  }

  @media (max-width: 860px)and(min-width: 700px) {
    .facebook-btn {
      font-size: $breakpointXS;

      .facebook-icon {
        font-size: $breakpointXS;
      }
    }
  }

  @media (max-width: 445px) {
    .facebook-btn {
      font-size: $breakpointXS;

      .facebook-icon {
        font-size: $breakpointXS;
      }
    }
  }

  @media (max-width: 360px) {
    .facebook-btn {
      font-size: $breakpointXXS;

      .facebook-icon {
        font-size: $breakpointXXS;
      }
    }
  }

  @media (max-width: 320px) {
    .facebook-icon {
      display: none;
    }
  }

  // @media (max-width: 400px) {
  //   .facebook-icon {
  //     display: none;
  //   }
  // }
</style>
