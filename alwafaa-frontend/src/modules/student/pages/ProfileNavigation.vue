<template>
  <div class="root">
    <div class="user-info">
      <div class="wrapper">
        <div class="top-section row">
          <!-- <div class="img">AS</div> -->
          <div class="name">Username</div>
        </div>
      </div>
    </div>
    <div class="user-list-section">
      <div class="wrapper">
        <ul class="user-list">
          <li class="user-item" @click="toggle('info')">
            <router-link
              to="/profile"
              class="link"
              :class="{ active: isSamePage }"
              >MY INFO</router-link
            >
          </li>
          <li class="user-item" @click="toggle('course')">
            <router-link
              to="/profile/my_courses"
              class="link"
              :class="{ active: isCourse }"
              >MY COURSES</router-link
            >
          </li>
          <li class="user-item" @click="toggle('setting')">
            <router-link
              to="/profile/pre-courses"
              class="link"
              :class="{ active: isPreCourse }"
              >PRE COURSES</router-link
            >
          </li>
        </ul>
      </div>
    </div>
    <div class="content">
      <div class="wrapper">
        <div class="info" v-if="isSamePage">
          <ValidationObserver v-slot="{ handleSubmit }" class="container">
            <form
              @submit.prevent="handleSubmit(submitForm)"
              class="form-container"
            >
              <div class="data">
                <ValidationProvider
                  class="input-validation"
                  rules="required"
                  v-slot="{ errors, invalid, validated }"
                >
                  <q-input
                    outlined
                    v-model="username"
                    label="Username"
                    :dense="dense"
                    class="input-field col-12 col-md"
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
                    outlined
                    v-model="email"
                    label="Email"
                    :dense="dense"
                    class="input-field col-12 col-md email"
                    color="secondary"
                    :error="invalid && validated"
                    :error-message="errors[0]"
                  />
                </ValidationProvider>
              </div>
              <div class="password">
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
                    class="form-input col-12 col-md"
                    label="Current Password"
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
                  name="confirm"
                  rules="required|pass"
                  v-slot="{ errors, invalid, validated }"
                >
                  <q-input
                    v-model="password"
                    outlined
                    dense
                    :type="isPwd ? 'password' : 'text'"
                    class="form-input col-12 col-md"
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
              </div>
              <q-btn
                :loading="loading4"
                color="primary"
                @click="submitForm"
                class="send"
                type="submit"
              >
                Send
                <template v-slot:loading>
                  <q-spinner-hourglass class="on-left" />
                  Sending...
                </template>
              </q-btn>
            </form>
          </ValidationObserver>
        </div>
        <q-drawer v-model="drawer" show-if-above :width="200" :breakpoint="400">
          <q-scroll-area
            style="
              height: calc(100% - 150px);
              margin-top: 150px;
              border-right: 1px solid #ddd;
            "
          >
            <q-list padding>
              <q-item clickable v-ripple>
                <q-item-section avatar>
                  <q-icon name="inbox" />
                </q-item-section>

                <q-item-section> Inbox </q-item-section>
              </q-item>

              <q-item active clickable v-ripple>
                <q-item-section avatar>
                  <q-icon name="star" />
                </q-item-section>

                <q-item-section> Star </q-item-section>
              </q-item>

              <q-item clickable v-ripple>
                <q-item-section avatar>
                  <q-icon name="send" />
                </q-item-section>

                <q-item-section> Send </q-item-section>
              </q-item>

              <q-item clickable v-ripple>
                <q-item-section avatar>
                  <q-icon name="drafts" />
                </q-item-section>

                <q-item-section> Drafts </q-item-section>
              </q-item>
            </q-list>
          </q-scroll-area>

          <q-img
            class="absolute-top"
            src="https://cdn.quasar.dev/img/material.png"
            style="height: 150px"
          >
            <div class="absolute-bottom bg-transparent">
              <q-avatar size="56px" class="q-mb-sm">
                <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
              </q-avatar>
              <div class="text-weight-bold">Razvan Stoenescu</div>
              <div>@rstoenescu</div>
            </div>
          </q-img>
        </q-drawer>
        <router-view />
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isSamePage: true,
      isCourse: false,
      isPreCourse: false,
      username: "",
      email: "",
      password: "",
      confirmPass: "",
      isPwd: true,
      isCPwd: true,
      dense: true,
      loading4: false,
      drawer: false,
    };
  },
  methods: {
    toggle(page) {
      if (page === "info") {
        this.isSamePage = true;
        this.isCourse = false;
        this.isPreCourse = false;
      } else if (page === "course") {
        this.isSamePage = false;
        this.isCourse = true;
        this.isPreCourse = false;
      } else if (page === "setting") {
        this.isSamePage = false;
        this.isCourse = false;
        this.isPreCourse = true;
      }
    },
    submitForm() {
      // eslint-disable-next-line no-unused-vars
      const user = {
        username: this.username,
        email: this.email,
        password: this.password,
      };
      if (
        this.username === "" ||
        this.email === "" ||
        this.password === "" ||
        this.confirmPass === ""
      ) {
        return;
      }
      console.log("clicke");
    },
  },
};
</script>
<style lang="scss" scoped>
.user-info {
  background-color: #f4f5f7;
  .wrapper {
    margin: 0 10%;
    padding: 30px;
    width: 80%;
    .top-section {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px 0;
      .img {
        font-size: 22px;
        height: 48px;
        width: 48px;
        border-radius: 50%;
        background: #ccc;
        text-align: center;
        padding-top: 7px;
        margin-right: 15px;
        font-weight: bold;
      }
      .name {
        font-size: 24px;
        font-weight: 500;
        line-height: 28px;
        color: $primary;
        margin-right: 10px;
      }
    }
  }
}
.user-list-section {
  background-color: #f4f5f7;
  border-bottom: 1px solid #dfe1e6;
  text-align: center;
  .wrapper {
    width: 80%;
    margin: 0 10%;
    .user-list {
      list-style: none;
      margin: 0;
      padding: 0;
      .user-item {
        display: inline-block;
        .link {
          background-color: #dfe1e6;
          border: 1px solid #dfe1e6;
          border-bottom: 0;
          border-radius: 3px 3px 0 0;
          display: inline-block;
          font-weight: 700;
          margin: 2px 2px 0;
          padding: 8px 20px;
          text-decoration: none;
          box-sizing: border-box;
          color: $secondary;
          @media screen and (max-width: 480px) {
            padding: 8px 5px;
          }
          @media screen and (max-width: 340px) {
            font-size: 10px;
            padding: 8px 5px;
          }
          &.active {
            background-color: #fff;
            border-color: #dfe1e6;
            cursor: pointer;
            margin-bottom: -1px;
            padding-bottom: 9px;
          }
          &:hover {
            background: $primary;
            color: #fff;
          }
        }
      }
    }
  }
}
.content {
  height: 100px;
  background: #fff;
  height: 500px;
  .wrapper {
    width: 80%;
    margin: 0 10%;
    .info {
      padding-top: 80px;

      .form-container {
        border: 3px solid $primary;
        border-radius: 4px;
        padding: 40px 0px;
        box-sizing: border-box;
        .data {
          .input-field {
            display: inline-block;
            width: 40%;
            margin: 0px 5%;
            @media screen and (max-width: 480px) {
              display: block;
              width: 80%;
              margin: 0 10%;
            }
            @media screen and (max-width: 340px) {
              display: block;
              width: 80%;
              margin: 0 10%;
            }
          }
        }
        .password {
          .form-input {
            display: inline-block;
            width: 40%;
            margin: 0px 5%;
            @media screen and (max-width: 480px) {
              display: block;
              width: 80%;
              margin: 0 10%;
            }
            @media screen and (max-width: 340px) {
              display: block;
              width: 80%;
              margin: 0 10%;
            }
          }
        }
        .send {
          width: 20%;
          margin: 0px 5%;
          @media screen and (max-width: 480px) {
            width: 40%;
            margin: 0 10%;
          }
          @media screen and (max-width: 340px) {
            width: 40%;
            margin: 0 10%;
          }
        }
      }
    }
  }
}
</style>
