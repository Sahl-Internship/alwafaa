<template>
  <auth-container>
    <ValidationObserver
      v-slot="{ handleSubmit }"
      class="flex justify-center container"
    >
      <q-form
        class="q-gutter-md flex justify-center signup"
        @submit.prevent="handleSubmit(submitForm)"
      >
        <h3 class="title">{{ $t("signupTitle") }}</h3>
        <ValidationProvider
          class="input-validation"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="firstname"
            class="form-input"
            outlined
            dense
            :label="$t('firstname')"
            color="secondary"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          class="input-validation"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="lastname"
            class="form-input"
            outlined
            dense
            :label="$t('lastname')"
            color="secondary"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          class="input-validation"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="username"
            class="form-input"
            outlined
            dense
            :label="$t('username')"
            color="secondary"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          class="input-validation"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="email"
            class="form-input"
            outlined
            dense
            type="email"
            :label="$t('email')"
            color="secondary"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          class="input-validation"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="phoneNumber"
            class="form-input"
            outlined
            dense
            type="tel"
            :label="$t('phoneNumber')"
            color="secondary"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          class="input-validation"
          name="confirm"
          rules="required|pass"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="password"
            outlined
            dense
            :type="isPwd ? 'password' : 'text'"
            class="form-input"
            :label="$t('password')"
            color="secondary"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
            <template v-slot:append>
              <q-icon
                :name="isPwd ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                @click="isPwd = !isPwd"
              ></q-icon>
            </template>
          </q-input>
        </ValidationProvider>

        <ValidationProvider
          class="input-validation"
          rules="required|confirmPass:@confirm"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="confirmPass"
            outlined
            dense
            :type="isCPwd ? 'password' : 'text'"
            class="form-input"
            :label="$t('confirmPass')"
            color="secondary"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
            <template v-slot:append>
              <q-icon
                :name="isCPwd ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                @click="isCPwd = !isCPwd"
              ></q-icon>
            </template>
          </q-input>
        </ValidationProvider>

        <ValidationProvider
          class="input-validation"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="country"
            class="form-input"
            outlined
            dense
            :label="$t('country')"
            color="secondary"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          class="input-validation"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="city"
            class="form-input"
            outlined
            dense
            :label="$t('city')"
            color="secondary"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          class="input-validation"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="birthdate"
            outlined
            dense
            class="form-input"
            type="date"
            color="secondary"
            :hint="$t('birthdate')"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
          <!-- <q-date v-model="birthdate" /> -->
        </ValidationProvider>

        <ValidationProvider
          class="input-validation"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-field
            :value="gender"
            hide-bottom-space
            borderless
            :error="invalid && validated"
            :error-message="errors[0]"
          >
            <q-radio
              keep-color
              v-model="gender"
              val="1"
              :label="$t('male')"
              color="secondary"
            />
            <q-radio
              keep-color
              v-model="gender"
              val="2"
              :label="$t('female')"
              color="secondary"
            />
          </q-field>
        </ValidationProvider>

        <q-btn :label="$t('submit')" type="submit" class="form-btn"></q-btn>

        <p class="separator">{{ $t("useSocial") }}</p>
        <google-btn></google-btn>
        <facebook-btn></facebook-btn>
      </q-form>
    </ValidationObserver>
  </auth-container>
</template>

<script>
import AuthContainer from "../layout/AuthContainer.vue";
import GoogleBtn from "../components/GoogleBtn";
import FacebookBtn from "../components/FacebookBtn.vue";

export default {
  components: { AuthContainer, GoogleBtn, FacebookBtn },
  name: "Signup",
  data() {
    return {
      firstname: "",
      lastname: "",
      username: "",
      email: "",
      phoneNumber: "",
      password: "",
      confirmPass: "",
      birthdate: "",
      gender: "",
      country: "",
      city: "",
      isPwd: true,
      isCPwd: true,
    };
  },
  methods: {
    submitForm() {
      const user = {
        firstname: this.firstname,
        lastname: this.lastname,
        username: this.username,
        email: this.email,
        phoneNumber: this.phoneNumber,
        password: this.password,
        birthdate: Math.round(new Date(this.birthdate).getTime() / 1000),
        gender: this.gender,
        country: this.country,
        city: this.city,
      };
      this.$store.dispatch("auth/signup", user);
    },
  },
};
</script>

<style lang="scss" scoped>
// .container {
//   margin-right: 20px;
//   margin-left: 20px;
// }
.signup {
  width: 70%;
  border: solid 4px $primary;
  border-radius: 7px;
  margin: 20px 0 0 0;
  padding: 0 15px 30px 0;
  background-color: #fff;

  .title {
    color: $secondary;
    margin: 20px 0;
  }

  .input-validation {
    width: 85%;
    margin-bottom: 10px;
  }

  .form-input {
    background-color: $ground;
    padding-bottom: 0;
  }

  .form-btn {
    background-color: $secondary;
    width: 85%;
    height: 45px;
    color: #fff;
    font-size: 20px;
    margin-top: 10px;
  }

  .separator {
    color: rgb(192, 192, 192);
    margin-bottom: 0;
    padding-bottom: 0;
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
