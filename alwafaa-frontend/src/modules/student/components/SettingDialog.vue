<template>
  <q-card
    class="q-mt-xl dialog-card"
    :class="$q.screen.lt.sm ? 'q-mx-xs' : 'q-mx-lg'"
  >
    <div class="col-12 text-left">
      <q-btn
        flat rounded
        type="button"
        icon="mdi-close"
        text-color="grey-4"
        size="md"
        class="q-mt-md q-ml-md"
        @click="$emit('closeDialog', 'editMode')"
      />
    </div>

    <q-card-section class="row justify-center q-pt-none">
      <div class="col-xs-12 col-sm-9 col-md-5">
        <div
          :class="{
            'q-ml-xl q-pl-lg text-left text-h6': !$q.screen.lt.sm,
            'text-center text-subtitle1': $q.screen.lt.sm,
          }"
        >{{ $t('student.setting.title') }}</div>
      </div>
    </q-card-section>

    <q-card-section class="row justify-center">
      <div class="col-xs-12 col-sm-8 col-md-4">
        <q-tabs
          v-model="tab"
          align="justify"
          indicator-color="green"
          active-color="grey-4"
          class="text-primary"
        >
          <q-tab no-caps :ripple="false" name="public" icon="mdi-earth" :label="$t('student.setting.public')" />
          <q-tab no-caps :ripple="false" name="privacy" icon="mdi-security" :label="$t('student.setting.privacy')" />
          <q-tab no-caps :ripple="false" name="security" icon="mdi-lock" :label="$t('student.setting.security')" />
        </q-tabs>
      </div>
    </q-card-section>

    <q-card-section class="row justify-center q-px-none q-mx-none">
      <div class="col-xs-12 col-sm-8 col-md-4">
        <q-tab-panels v-model="tab" animated>
          <q-tab-panel name="public">
            <ValidationObserver v-slot="{ handleSubmit }">
              <q-form
                ref="firstForm"
                @submit.prevent="handleSubmit(submitFirstForm)"
                class="row justify-center"
              >
                <ValidationProvider
                  name="firstname"
                  class="col-xs-6 col-sm-6 col-md-6 q-pr-xs q-pb-xs"
                  rules="required"
                  v-slot="{ errors, invalid, validated }"
                >
                  <g-input
                    dense
                    outlined
                    v-model="user.firstname"
                    :label="$t('formFields.firstname')"
                    prependIconName="mdi-account"
                    bg-color='grey-1'
                    :error="invalid && validated"
                    :error-message="errors[0]"
                  />
                </ValidationProvider>

                <ValidationProvider
                  name="lastname"
                  class="col-xs-6 col-sm-6 col-md-6 q-pb-xs"
                  rules="required"
                  v-slot="{ errors, invalid, validated }"
                >
                  <g-input
                    dense
                    outlined
                    v-model="user.lastname"
                    :label="$t('formFields.lastname')"
                    prependIconName="mdi-account"
                    bg-color='grey-1'
                    :error="invalid && validated"
                    :error-message="errors[0]"
                  />
                </ValidationProvider>

                <q-input
                  dense
                  outlined
                  v-model="user.birthdate"
                  :label="$t('formFields.birthdate')"
                  mask="date"
                  bg-color="grey-1"
                  class="col-12"
                >
                  <template v-slot:prepend>
                    <q-icon name="event" class="cursor-pointer" size="sm" color="grey-5">
                      <q-popup-proxy
                        ref="qDateProxy"
                        transition-show="scale"
                        transition-hide="scale"
                      >
                        <q-date v-model="user.birthdate">
                          <div class="row items-center justify-end">
                            <q-btn v-close-popup label="Close" color="primary" flat />
                          </div>
                        </q-date>
                      </q-popup-proxy>
                    </q-icon>
                  </template>

                  <template v-slot:append>
                    <q-icon name="event" class="cursor-pointer" size="20px" color="grey-3" />
                  </template>
                </q-input>

                <div
                  class="col-12 row justify-between q-mt-md q-pa-xs hobbies-box"
                >
                  <div
                    class="text-h5 text-center q-mx-xs hash-icon"
                  >#</div>
                  <div class="col-11 row q-gutter-x-lg q-gutter-y-sm q-mt-sm justify-start">
                    <div
                      v-for="(hobby, index) in user.bio"
                      :key="index"
                      class="row items-center"
                      style="height: 30px"
                    >
                      <div
                        class="text-subtitle2 relative hobby-box q-px-md text-grey-5 bg-grey-2"
                        :style="checkDirection ?
                          'top: 10px; right: 15px; transform: translateY(-50%);'
                          : 'top: 13px; left: -7px; transform: translateY(-50%);'"
                      >
                        {{ hobby }}
                        <q-btn
                          dense
                          rounded
                          icon="mdi-close"
                          color="grey-3"
                          text-color="grey-5"
                          size="xs"
                          :style="checkDirection ?
                            'top: 13px; right: -10px; transform: translateY(-50%);'
                            : 'top: 13px; left: -10px; transform: translateY(-50%);'"
                          class="absolute"
                          @click="removeHobby(hobby)"
                        />
                      </div>
                    </div>
                    <textarea
                      borderless
                      type="textarea"
                      v-model="newHobby"
                      class="col-11 hobbies-inp"
                      @keyup.enter="addHobby"
                    />
                  </div>
                  <q-separator vertical size="2px" color="grey-3" />
                </div>

                <div class="col-12 row reverse q-mt-lg">
                  <g-btn
                    dense
                    label="signup.continue"
                    :icon-right="checkDirection ? 'mdi-chevron-left' : 'mdi-chevron-right'"
                    :width="!$q.screen.lt.sm ? 'col-4' : 'col-5'"
                    size="md"
                  />
                </div>

              </q-form>
            </ValidationObserver>
          </q-tab-panel>

          <q-tab-panel name="privacy">
            <ValidationObserver v-slot="{ handleSubmit }">
              <q-form
                class="row justify-center"
                @submit.prevent="handleSubmit(submitSecForm)"
              >
                <div class="col-12 row phone">
                  <ValidationProvider
                    name="phone"
                    class="col-xs-9 col-sm-9 col-md-9 q-pb-xs phone-input"
                    rules="required|numeric"
                    v-slot="{ errors, invalid, validated }"
                  >
                    <g-input
                      dense
                      borderless
                      v-model="user.phone"
                      :label="$t('formFields.phone')"
                      bg-color='grey-1'
                      prependIconName="mdi-phone"
                      :error="invalid && validated"
                      :error-message="errors[0]"
                    />
                  </ValidationProvider>

                  <ValidationProvider
                    name="phone-key"
                    class="col-xs-3 col-sm-3 col-md-3 q-pb-xs phone-select"
                    rules="required"
                    v-slot="{ errors, invalid, validated }"
                  >
                    <g-select
                      dense
                      borderless
                      v-model="user.phone_key"
                      bg-color='grey-1'
                      :options="dialCodesOPtions"
                      :error="invalid && validated"
                      :error-message="errors[0]"
                    />
                  </ValidationProvider>
                </div>

                <ValidationProvider
                  name="country"
                  class="col-12 q-pb-xs"
                  rules="required"
                  v-slot="{ errors, invalid, validated }"
                >
                  <g-select
                    dense
                    outlined
                    v-model="user.country"
                    :options="countriesNamesOptions"
                    :label="$t('formFields.country')"
                    prependIconName="mdi-flag-variant"
                    bg-color='grey-1'
                    :flag="isoCode"
                    :error="invalid && validated"
                    :error-message="errors[0]"
                  />
                </ValidationProvider>

                 <ValidationProvider
                  name="city"
                  class="col-12 q-pb-xs"
                  rules="required"
                  v-slot="{ errors, invalid, validated }"
                >
                  <g-input
                    dense
                    outlined
                    v-model="user.city"
                    :label="$t('formFields.city')"
                    prependIconName="mdi-city"
                    bg-color='grey-1'
                    :error="invalid && validated"
                    error-message="errors[0]"
                  />
                 </ValidationProvider>

                <div class="col-12 row justify-between q-mt-md">
                  <q-btn
                    dense
                    flat
                    type="button"
                    :label="$t('student.setting.back')"
                    :icon="checkDirection ? 'mdi-chevron-right' : 'mdi-chevron-left'"
                    size="md"
                    @click="goBack('public')"
                    class="back-btn"
                    :class="!$q.screen.lt.sm ? 'col-4' : 'col-6'"
                  />

                  <g-btn
                    dense
                    label="signup.continue"
                    :icon-right="checkDirection ? 'mdi-chevron-left' : 'mdi-chevron-right'"
                    :width="!$q.screen.lt.sm ? 'col-4' : 'col-5'"
                    size="md"
                  />
                </div>
              </q-form>
            </ValidationObserver>
          </q-tab-panel>

          <q-tab-panel name="security">
            <q-form
              class="row justify-center"
              @submit.prevent="submitForm"
            >
              <g-input
                dense
                outlined
                v-model="password"
                type="password"
                :label="$t('formFields.password')"
                prependIconName="mdi-key"
                appendIconName="mdi-eye-off"
                bg-color='grey-1'
                class="col-12 q-pb-sm"
              />
              <g-input
                dense
                outlined
                v-model="confirmPass"
                type="password"
                :label="$t('formFields.confirmPass')"
                prependIconName="mdi-key"
                appendIconName="mdi-eye-off"
                bg-color='grey-1'
                class="col-12 q-pb-sm"
              />

              <div class="col-12 row justify-between q-mt-xl">
                <q-btn
                  dense
                  flat
                  type="button"
                  :label="$t('student.setting.back')"
                  :icon="checkDirection ? 'mdi-chevron-right' : 'mdi-chevron-left'"
                  size="md"
                  @click="goBack('privacy')"
                  class="back-btn"
                  :class="!$q.screen.lt.sm ? 'col-4' : 'col-6'"
                />

                <g-btn
                  dense
                  label="signup.finish"
                  :icon-right="checkDirection ? 'mdi-chevron-left' : 'mdi-chevron-right'"
                  :width="!$q.screen.lt.sm ? 'col-4' : 'col-5'"
                  size="md"
                />
              </div>
            </q-form>
          </q-tab-panel>
        </q-tab-panels>
      </div>
    </q-card-section>

  </q-card>
</template>

<script>
import { dialCodes, countriesNames, getSelectedCountry } from 'src/utils/countries.js'

export default {
  data () {
    return {
      tab: 'public',
      user: {},
      password: '',
      confirmPass: '',
      dialCodesOPtions: dialCodes,
      isoCode: '',
      newHobby: ''
      // bio: ['النحو', 'أحكام القرآن', 'الشعر', 'معرفة', 'الفصاحة'],
    }
  },
  computed: {
    checkDirection () {
      return this.$q.lang.rtl
    },
    checkLanguage () {
      return this.$q.lang.rtl ? 'ar' : 'en'
    },
    countriesNamesOptions () {
      return countriesNames(this.checkLanguage)
    }
  },
  methods: {
    submitFirstForm () {
      this.tab = 'privacy'
    },
    submitSecForm () {
      this.tab = 'security'
    },
    submitForm () {
      const studentData = {
        ...this.user,
        birthdate: Math.round(new Date(this.user.birthdate).getTime() / 1000)
      }

      if (this.password) {
        studentData.password = this.password
      }

      this.$store.dispatch('student/editStudentData', studentData).then(res => {
        console.log('res', res)
      })
    },
    goBack (value) {
      this.tab = value
    },
    removeHobby (name) {
      this.user.bio = this.user.bio.filter(hobby => hobby !== name)
    },
    addHobby (e) {
      this.user.bio.push(this.newHobby)
      this.newHobby = ''
    }
  },
  watch: {
    user: {
      handler ({ country }) {
        if (country) {
          const selectedCountry = getSelectedCountry(country, this.checkLanguage)
          this.isoCode = selectedCountry.code
          this.user.phone_key = selectedCountry.dial_code
        }
      },
      deep: true
    }
  },
  mounted () {
    const student = this.$store.getters['auth/getUser']
    this.user = {
      ...student,
      bio: student.bio ? student.bio : []
    }
  }
}
</script>

<style lang="scss" scoped>
.dialog-card {
  height: 90%;
}
.q-tabs {
  &::v-deep {
    .q-tab__label {
      font-size: 18px;
    }

    .q-tab {
      border-bottom: solid 1.5px $grey-1;
      color: $grey-3;
    }

    .q-tab__indicator {
      height: 3px;
      width: 85px;
      margin: auto;
    }

    @media (max-width: 600px) {
      .q-tab__label {
        font-size: 13px;
      }
    }
  }

}
  .phone-input .q-input {
    &::v-deep {
      .q-field__control:before {
        border: solid 1.5px rgba(0, 0, 0, 0.05);
        border-right: none;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
      }
      .q-field--focused {
        border: solid 1.5px $primary;
        outline: solid 1.5px $primary;
      }
      .q-field__prepend {
        padding-left: 12px;
      }
    }
  }

.phone-select .q-select {
  &::v-deep {
    .q-field__control:before {
      border: 1.5px solid rgba(0, 0, 0, 0.05);
      border-left-color: $grey-2;
      border-top-right-radius: 4px;
      border-bottom-right-radius: 4px;
    }
    .q-field__control-container {
      padding-top: 10px;
    }
    .q-field__native {
      direction: rtl;
    }
    .q-field__append {
      // padding-left: 5px;
      padding-right: 12px;
    }
  }
}

.back-btn {
  margin-left: -30px;
}

.hobbies-box {
  border: solid 2px rgba(0, 0, 0, 0.07);
  border-radius: 3px;
}

.hobbies-inp {
  resize: none;
  border: none;
  height: 25px;
}
.hobbies-inp:focus {
  border: none;
  outline: none;
}

.hobby-box {
  height: 27px;
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
  box-shadow: -5px 0px 5px 0px $grey-3;
}

.hash-icon {
  -ms-transform: rotate(12deg); /* IE 9 */
  transform: rotate(12deg);
  margin-right: 25px;
}

.q-input, .q-select {
  &::v-deep {
    .q-field__control:before  {
      border: 1.5px solid rgba(0, 0, 0, 0.05);
    }
  }
}
</style>
