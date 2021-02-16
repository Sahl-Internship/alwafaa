<template>
  <auth-container>
    <ValidationObserver
      v-slot="{ handleSubmit }"
      class="flex justify-center col-xs-11 col-sm-11 col-md-9 col-lg-9 q-my-md"
    >
      <q-form
        class="row q-gutter-x-xs q-pb-lg justify-center reset-pass-form"
        @submit.prevent="handleSubmit(submitForm)"
      >
        <h4 class="col-12 q-my-lg title">Verify Email</h4>

        <ValidationProvider
          class="col-10"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="email"
            outlined
            type="email"
            :label="$t('email')"
            color="blue-1"
            bg-color="grey-1"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
          </q-input>
        </ValidationProvider>

        <q-btn
          dense
          no-caps
          label="Reset Password"
          type="submit"
          color="primary"
          text-color="white"
          class="col-10 form-btn"
        ></q-btn>
      </q-form>
    </ValidationObserver>
  </auth-container>
</template>

<script>
import AuthContainer from "../layout/AuthContainer.vue";

export default {
  components: {
    AuthContainer,
  },
  data() {
    return {
      email: "",
    };
  },
  methods: {
    submitForm() {
      const email = {
        email: this.email,
      };
      this.$store.dispatch("auth/forgotPassword", email);
    },
  },
};
</script>
<style lang="scss" scoped>
.reset-pass-form {
  border: solid 1px $grey-2;
  border-radius: 7px;
  background-color: #fff;
  box-shadow: 1px 10px 10px 5px $grey-3;

  .title {
    color: $grey;
    text-align: center;
  }

  .form-btn {
    font-size: 20px;
  }
}

@media (max-width: 860px) and(min-width: 700px) {
  .title {
    font-size: 25px;
  }
}

@media (max-width: 500px) {
  .title {
    font-size: 30px;
  }
}
</style>
