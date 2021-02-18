import { Notify, Loading } from "quasar";
import {
  handleSignup,
  handleLogin,
  handleForgotPass,
  handleResetPassword,
} from "src/services/authApi";

export default {
  async signup(context, user) {
    Loading.show();

    try {
      const response = await handleSignup(user);
      if (response.data.status !== 1) {
        const messages = Object.keys(response.data.message);
        const errors = messages.map((item) => `${item} not valid`);
        const errorMessage = errors.join(", ");
        const error = new Error(errorMessage);
        throw error;
      }

      this.$router.push({
        name: "login",
      });

      Notify.create({
        type: "positive",
        message: "You registered successfully, confirm your email to login",
      });
    } catch (error) {
      Loading.hide();

      Notify.create({
        type: "negative",
        message: error.message
          ? error.message
          : "Error while registering, Try Again",
      });
    }

    Loading.hide();
  },
  async login(context, userData) {
    Loading.show();
    try {
      const response = await handleLogin(userData);

      if (response.data.status !== 1) {
        const err = new Error(response.data.message);
        throw err;
      }

      const { token, ...user } = response.data.profile;
      localStorage.setItem("token", token);
      context.commit("loginState", {
        token,
        user,
      });

      this.$router.push({
        name: "home",
      });
    } catch (error) {
      Loading.hide();

      Notify.create({
        type: "negative",
        message: error.message ? error.message : "Invalid Data",
      });
    }
    Loading.hide();
  },
  async forgotPassword(context, email) {
    Loading.show();

    try {
      const response = await handleForgotPass(email);
      console.log(response);
    } catch (error) {
      Loading.hide();
      console.log(error);
    }
    Loading.hide();
  },
  async resetPassword(context, password) {
    console.log(this.$route);
    Loading.show();

    try {
      const response = await handleResetPassword(password);
      console.log(response);
    } catch (error) {
      Loading.hide();
      console.log(error);
    }
    Loading.hide();
  },
  logout({ commit }) {
    commit("logout");
    localStorage.removeItem("token");
    this.$router.push({ name: "login" });
  },
};
