import { Notify, Loading } from "quasar";
import { handleSignup, handleLogin } from "src/services/authApi";
// import router from "../../router";

export default {
  async signup(context, user) {
    // Loading.show();
    // try {
    const response = await handleSignup(user);
    if (response.data.status !== 1) {
      const messages = Object.keys(response.data.message);
      const errors = messages.map((item) => `${item} not valid`);
      const errorMessage = errors.join(", ");
      const error = new Error(errorMessage);
      throw error;
    }

    //   Notify.create({
    //     type: "positive",
    //     message: "You registered successfully, confirm your email to login",
    //   });
    // } catch (error) {
    //   Loading.hide();

    //   Notify.create({
    //     type: "negative",
    //     message: error.message
    //       ? error.message
    //       : "Error while registering, Try Again",
    //   });
    // }

    // Loading.hide();
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
      context.commit("loginState", { token, user });

      this.$router.push({ name: "home" });
    } catch (error) {
      Loading.hide();

      Notify.create({
        type: "negative",
        message: error.message ? error.message : "Invalid Data",
      });
    }
    Loading.hide();
  },
};
