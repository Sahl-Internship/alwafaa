<template>
  <div class="row justify-center">
    <div
      class="col-12 text-weight-bold text-center q-mt-xl text-grey-5"
      :class="{
        'text-h4': !$q.screen.lt.sm,
        'text-h5': $q.screen.lt.sm
      }"
    >
      {{ $t("signup.title") }}
    </div>
    <q-separator class="col-2" spaced="lg" size="3px" color="grey-2" />

    <div class="col-12 q-mt-lg">
      <div class="row justify-center">
        <div class="col-xs-4 col-sm-3 text-subtitle1 text-bold text-center text-grey-4">
          {{ $t("signup.firstFormTitle") }}
        </div>
        <div class="col-xs-4 col-sm-3 text-subtitle1 text-bold text-center text-grey-4">
          {{ $t("signup.secondFormTitle") }}
        </div>
        <div class="col-xs-4 col-sm-3 text-subtitle1 text-bold text-center text-grey-4">
          {{ $t("signup.thirdFormTitle") }}
        </div>
      </div>
    </div>

    <div class="col-xs-10 col-sm-7">
      <q-stepper
        v-model="step"
        ref="stepper"
        contracted
        color="primary"
        done-color="green"
        inactive-color="grey-2"
        animated
        flat
      >
        <q-step
          :name="1"
          :title="$t('signup.firstFormTitle')"
          :done="step > 1"
        >
          <ValidationObserver v-slot="{ handleSubmit }">
            <q-form
              @submit.prevent="handleSubmit(validateFirstForm)"
              class="row justify-center"
            >
              <ValidationProvider
                name="firstname"
                class="col-6 q-pr-xs"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  outlined
                  v-model="firstname"
                  :label="$t('formFields.firstname')"
                  color="primary"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                  aria-errormessage=""
                >
                  <template v-slot:prepend>
                    <q-icon name="mdi-account" />
                  </template>
                </q-input>
              </ValidationProvider>

              <ValidationProvider
                name="lastname"
                class="col-6"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  v-model="lastname"
                  outlined
                  :label="$t('formFields.lastname')"
                  color="primary"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                  <template v-slot:prepend>
                    <q-icon name="mdi-account" />
                  </template>
                </q-input>
              </ValidationProvider>

              <ValidationProvider
                name="gender"
                class="col-12"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <q-select
                  outlined
                  v-model="gender"
                  :options="genderOptions"
                  :label="$t('formFields.gender')"
                  color="primary"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                  <template v-slot:prepend>
                    <q-icon name="mdi-human-male-female" />
                  </template>
                </q-select>
              </ValidationProvider>

              <ValidationProvider
                name="countary"
                class="col-12"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <q-select
                  outlined
                  v-model="country"
                  :options="countriesNamesOptions"
                  :label="$t('formFields.country')"
                  color="primary"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                  <template v-slot:prepend>
                    <flag v-if="isoCode" :iso="isoCode" class="flag-icon-circle" />
                    <q-icon v-else name="mdi-flag-variant" />
                  </template>
                </q-select>
              </ValidationProvider>

              <ValidationProvider
                name="city"
                class="col-12"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  v-model="city"
                  outlined
                  :label="$t('formFields.city')"
                  color="primary"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                  <template v-slot:prepend>
                    <q-icon name="mdi-city" />
                  </template>
                </q-input>
              </ValidationProvider>

              <q-btn
                no-caps
                type="submit"
                :label="step === 3 ? $t('signup.finish') : $t('signup.continue')"
                icon-right="fas fa-chevron-left"
                class="col-5 q-mt-md"
                color="primary"
                size="lg"
              />
            </q-form>
          </ValidationObserver>
        </q-step>

        <q-step
          :name="2"
          :title="$t('signup.secondFormTitle')"
          :done="step > 2"
        >
          <ValidationObserver v-slot="{ handleSubmit }">
            <q-form
              @submit.prevent="handleSubmit(submitData)"
              class="row justify-center"
            >
              <ValidationProvider
                name="email"
                class="col-12"
                rules="required|email"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  v-model="email"
                  outlined
                  type="email"
                  :label="$t('formFields.email')"
                  color="primary"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                  <template v-slot:prepend>
                    <q-icon name="mdi-account" />
                  </template>
                  <template v-slot:append v-if="!!email && (!invalid || !validated)">
                    <q-icon name="fas fa-check" color="green" size="xs" />
                  </template>
                </q-input>
              </ValidationProvider>

              <div class="col-12 row phone">
                <ValidationProvider
                  name="phone"
                  class="col-xs-9 col-sm-9 col-md-10 col-lg-10 phone-input"
                  rules="required|numeric"
                  v-slot="{ errors, invalid, validated }"
                >
                  <q-input
                    borderless
                    v-model="phoneNumber"
                    :label="$t('formFields.phone')"
                    color="primary"
                    :error="invalid && validated"
                    :error-message="errors[0]"
                  >
                    <template v-slot:prepend>
                      <q-icon name="mdi-phone" />
                    </template>
                  </q-input>
                </ValidationProvider>

                <ValidationProvider
                  name="phone"
                  class="col-xs-3 col-sm-3 col-md-2 col-lg-2 phone-select"
                  rules="required"
                  v-slot="{ errors, invalid, validated }"
                >
                  <q-select
                    borderless
                    v-model="phoneKey"
                    :options="dialCodesOPtions"
                    :error="invalid && validated"
                    :error-message="errors[0]"
                  />
                </ValidationProvider>
              </div>

              <ValidationProvider
                name="password"
                class="col-12"
                rules="required|min:7"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  v-model="password"
                  outlined
                  type="password"
                  :label="$t('formFields.password')"
                  color="primary"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                  <template v-slot:prepend>
                    <q-icon name="mdi-key" />
                  </template>
                  <template v-slot:append v-if="!!password && (!invalid || !validated)">
                    <q-icon name="fas fa-check" color="green" size="xs" />
                  </template>
                </q-input>
              </ValidationProvider>

              <ValidationProvider
                name="confirm-password"
                class="col-12"
                rules="required|confirmed:password"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  v-model="confirmPass"
                  outlined
                  type="password"
                  :label="$t('formFields.confirmPass')"
                  color="primary"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                  <template v-slot:prepend>
                    <q-icon name="mdi-key" />
                  </template>
                  <template v-slot:append v-if="!!confirmPass && (!invalid || !validated)">
                    <q-icon name="fas fa-check" color="green" size="xs" />
                  </template>
                </q-input>
              </ValidationProvider>

              <q-btn
                no-caps
                type="submit"
                :label="step === 3 ? $t('signup.finish') : $t('signup.continue')"
                icon-right="fas fa-chevron-left"
                class="col-5 q-mt-md"
                color="primary"
                size="lg"
              />
            </q-form>
          </ValidationObserver>
        </q-step>

        <q-step
          :name="3"
          :title="$t('signup.thirdFormTitle')"
        >
          <div
            class="text-weight-bold text-center text-grey-4"
            :class="{
              'text-h5': !$q.screen.lt.sm,
              'text-h6': $q.screen.lt.sm
            }"
          >
            {{ $t('signup.checkEmail') }}
          </div>

          <div class="text-subtitle1 text-center q-mt-md email-sent text-grey-4">
            {{ $t('signup.emailSent') }}
          </div>

          <div class="row justify-center q-mt-sm">
            <q-btn flat type="button" :label="$t('signup.resend')" class="text-line text-font" />

            <q-btn
              flat
              type="button"
              :label="$t('signup.edit')"
              :class="{
                'q-mx-xs': !$q.screen.lt.md,
                'q-mx-none': $q.screen.lt.md,
                'text-line': true,
                'text-font': true
              }"
              @click="$refs.stepper.previous()"
            />

            <div class="text-subtitle1 text-font">{{ email }}</div>
          </div>

          <ValidationObserver v-slot="{ handleSubmit }">
            <q-form
              @submit.prevent="handleSubmit(submitVerfication)"
              class="row justify-center q-mt-xl"
            >
              <ValidationProvider
                name="verfication-code"
                class="col-12"
                rules="required"
                v-slot="{ errors, invalid, validated }"
              >
                <q-input
                  v-model="verficationCode"
                  outlined
                  type="text"
                  :label="$t('formFields.verficationCode')"
                  color="primary"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                >
                  <template v-slot:prepend>
                    <q-icon name="mdi-shield-check" />
                  </template>
                  <template v-slot:append v-if="!!verficationCode && (!invalid || !validated)">
                    <q-icon name="fas fa-check" color="green" size="xs" />
                  </template>
                </q-input>
              </ValidationProvider>

              <q-checkbox
                :label="$t('signup.read')"
                v-model="agree"
                color="primary"
                class="col-12"
              >
                <span class="text-line"> {{ $t('signup.rules') }}</span>
              </q-checkbox>

              <q-btn
                no-caps
                type="submit"
                :disable="!agree"
                :label="step === 3 ? $t('signup.finish') : $t('signup.continue')"
                class="col-6 q-mt-md"
                color="primary"
                size="lg"
              />
            </q-form>
          </ValidationObserver>
        </q-step>
      </q-stepper>
    </div>

  </div>
</template>

<script>
import { dialCodes, countriesNames, getSelectedCountry } from 'src/utils/countries.js'

export default {
  name: 'Signup',
  data () {
    return {
      step: 1,
      firstname: '',
      lastname: '',
      gender: '',
      country: '',
      city: '',
      email: '',
      phoneNumber: '',
      phoneKey: '',
      password: '',
      confirmPass: '',
      verficationCode: '',
      agree: false,
      genderOptions: ['Female', 'Male'],
      countriesNamesOptions: countriesNames,
      dialCodesOPtions: dialCodes,
      isoCode: ''
    }
  },
  methods: {
    validateFirstForm () {
      console.log({
        firstname: this.firstname,
        lastname: this.lastname,
        gender: this.gender === 'Male' ? '1' : '2',
        country: this.country,
        city: this.city
      })
      this.$refs.stepper.next()
    },
    // submitForm () {
    //   const user = {
    //     firstname: this.firstname,
    //     lastname: this.lastname,
    //     email: this.email,
    //     phone: this.phoneNumber,
    //     password: this.password,
    //     country: this.country,
    //     city: this.city
    //   }

    //   this.$store.dispatch('auth/signup', user)
    // },
    submitData () {
      console.log({
        email: this.email,
        phone: `${this.phoneKey}${this.phoneNumber}`,
        password: this.password
      })
      this.$refs.stepper.next()
    },
    submitVerfication () {
      // send code
    }
  },
  watch: {
    country (newVal) {
      const selectedCountry = getSelectedCountry(newVal)
      this.isoCode = selectedCountry.code
      this.phoneKey = selectedCountry.dial_code
    }
  }
}
</script>

<style lang="scss" scoped>
.q-stepper {
  &::v-deep {
    .q-stepper__header {
      height: 50px;
      min-height: 40px;
    }
    .q-stepper__tab {
      padding: 0;
      height: 25px;
      min-height: 20px;
    }
    .q-stepper__dot {
      width: 12px;
      height: 12px;
      min-width: 8px;
    }
    .q-stepper__tab--active .q-stepper__dot {
      width: 19px;
      height: 19px;
    }
    .q-stepper__tab--done .q-stepper__dot {
      width: 23px;
      height: 23px;
    }
    .q-stepper__tab .q-stepper__dot::before,
    .q-stepper__tab .q-stepper__dot::after {
      margin: 0;
    }
    .q-stepper__tab--active .q-stepper__dot::before,
    .q-stepper__tab--done .q-stepper__dot::before,
    .q-stepper__tab--done .q-stepper__dot::after {
      background-color: $primary;
      height: 2px;
    }
    .fa-pencil-alt {
      font-size: 9px;
    }
    .q-stepper__step-inner {
      padding: 30px 0;
    }
  }

  .q-btn {
    &::v-deep {
      .q-icon {
        font-size: 17px;
      }
    }
  }

  .phone-input .q-input {
    &::v-deep {
      .q-field__inner {
        border: solid 1px $grey-3;
        border-right: none;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
      }
      .q-field__inner:hover {
        border-color: $grey-5;
      }
    }
  }

  .phone-select .q-select {
    &::v-deep {
      .q-field__inner {
        border: solid 1px $grey-3;
        border-left-color: $grey-3;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
      }
      .q-field__inner:hover {
        border-color: $grey-5;
        border-left-color: $grey-2;
      }
      .q-field__native {
        // padding-left: 3px;
        direction: rtl;
        text-align: center;
      }
      .q-field__append {
        padding-left: 5px;
      }
    }
  }

  .phone:hover {
    &::v-deep {
      .q-select .q-field__inner {
        border-color: $grey-5;
        border-left-color: $grey-2;
      }
    }
  }

  .email-sent {
    font-size: 21px;
  }
  .text-line {
    text-decoration: underline;
  }

  .flag-icon-circle {
    border-radius: 30px;
  }

  @media (max-width: 900px) {
    .text-font {
      font-size: 12px;
    }
  }

  @media (max-width: 850px) and (min-width: 730px) {
    .email-sent {
      font-size: 18px;
    }
  }

  @media (max-width: 730px) and (min-width: 600px){
    .email-sent {
      font-size: 14px;
    }

    .text-font {
      font-size: 9px;
    }
  }

  @media (max-width: 599px) and (min-width: 400px) {
    .email-sent {
      font-size: 18px;
    }
  }

   @media (max-width: 400px) {
    .email-sent {
      font-size: 15px;
    }

    .text-font {
      font-size: 9px;
    }
  }
}

</style>
