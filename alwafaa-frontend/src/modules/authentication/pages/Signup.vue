<template>
  <auth-layout>
    <ValidationObserver
      v-slot="{ handleSubmit }"
      class="flex justify-center col-xs-11 col-sm-11 col-md-9 col-lg-9 q-my-md"
    >
      <q-form
        class="row q-gutter-x-xs q-pb-lg justify-center signup"
        @submit.prevent="handleSubmit(submitForm)"
        ref="signupForm"
      >
        <h4 class="col-12 q-my-lg title">{{ $t("signupTitle") }}</h4>

        <ValidationProvider
          name="firstname"
          class="col-5"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            outlined
            dense
            v-model="firstname"
            :label="$t('firstname')"
            color="blue-1"
            bg-color="grey-1"
            :error="invalid && validated"
            :error-message="errors[0]"
            aria-errormessage=""
          />
        </ValidationProvider>

        <ValidationProvider
          name="lastname"
          class="col-5"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="lastname"
            outlined
            dense
            :label="$t('lastname')"
            color="blue-1"
            bg-color="grey-1"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          name="email"
          class="col-10"
          rules="required|email"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="email"
            outlined
            dense
            type="email"
            :label="$t('email')"
            color="blue-1"
            bg-color="grey-1"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          class="col-10"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="phoneNumber"
            outlined
            dense
            type="tel"
            :label="$t('phoneNumber')"
            color="blue-1"
            bg-color="grey-1"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          name="password"
          class="col-10"
          rules="required|min:7"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="password"
            outlined
            dense
            :type="isPwd ? 'password' : 'text'"
            :label="$t('password')"
            color="blue-1"
            bg-color="grey-1"
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
          name="confirm-password"
          class="col-10 input-validation"
          rules="required|confirmed:password"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="confirmPass"
            outlined
            dense
            :type="isCPwd ? 'password' : 'text'"
            :label="$t('confirmPass')"
            color="blue-1"
            bg-color="grey-1"
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
          name="countary"
          class="col-5"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            v-model="country"
            outlined
            dense
            :label="$t('country')"
            color="blue-1"
            bg-color="grey-1"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          name="birthdate"
          class="col-5"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <!-- <q-input
            v-model="birthdate"
            outlined
            dense
            type="date"
            color="blue-1"
            bg-color="grey-1"
            :hint="$t('birthdate')"
            :error="invalid && validated"
            :error-message="errors[0]"
          /> -->
          <q-input
            outlined
            dense
            v-model="birthdate"
            :label="$t('birthdate')"
            mask="date"
            bg-color="grey-1"
            :error="invalid && validated"
            :error-message="errors[0]"
          >
            <template v-slot:append>
              <q-icon name="event" class="cursor-pointer">
                <q-popup-proxy
                  ref="qDateProxy"
                  transition-show="scale"
                  transition-hide="scale"
                >
                  <q-date v-model="birthdate">
                    <div class="row items-center justify-end">
                      <q-btn v-close-popup label="Close" color="primary" flat />
                    </div>
                  </q-date>
                </q-popup-proxy>
              </q-icon>
            </template>
          </q-input>
        </ValidationProvider>

        <ValidationProvider
          name="gender"
          class="col-10"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-field
            dense
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
              color="grey"
            />
            <q-radio
              keep-color
              v-model="gender"
              val="2"
              :label="$t('female')"
              color="grey"
            />
          </q-field>
        </ValidationProvider>

        <q-btn
          dense
          no-caps
          :label="$t('submit')"
          type="submit"
          color="primary"
          text-color="grey-1"
          class="col-10 q-mt-md form-btn"
        ></q-btn>

        <!-- <google-btn status="signup"></google-btn> -->
        <!-- <facebook-btn status="signup"></facebook-btn> -->
      </q-form>
    </ValidationObserver>
  </auth-layout>
</template>

<script>
import AuthLayout from '../layout/AuthLayout.vue'

export default {
  components: { AuthLayout },
  name: 'Signup',
  data () {
    return {
      firstname: '',
      lastname: '',
      email: '',
      phoneNumber: '',
      password: '',
      confirmPass: '',
      birthdate: '',
      gender: '',
      country: '',
      isPwd: true,
      isCPwd: true
    }
  },
  methods: {
    submitForm () {
      const user = {
        firstname: this.firstname,
        lastname: this.lastname,
        email: this.email,
        phone: this.phoneNumber,
        password: this.password,
        birthdate: Math.round(new Date(this.birthdate).getTime() / 1000),
        gender: this.gender,
        country: this.country
      }

      this.$store.dispatch('auth/signup', user)
    }
  },
  mounted () {
    this.$refs.signupForm.validate()
  }
}
</script>

<style lang="scss" scoped>
.signup {
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
