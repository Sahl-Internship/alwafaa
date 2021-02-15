import { Notify, Loading } from "quasar";
import { handleSignup, handleLogin } from "src/services/authApi";
import router from "../../router";

export default {
  async signup(context, user) {
    Loading.show();
    try {
      const response = await handleSignup(user);
      console.log(response);
      if (response.statusText !== "OK") {
        const error = new Error({
          message: "Error while registering, Try Again",
        });
        throw error;
      }
      Notify.create({
        type: "positive",
        message: "You registered successfully, confirm your email to login",
      });
    } catch (error) {
      Loading.hide();
      console.log("error", error);
      Notify.create({
        type: "negative",
        message: "Error while registering, Try Again",
      });
    }
    Loading.hide();
  },
  async login(context, userData) {
    Loading.show();
    try {
      const response = await handleLogin(userData);
      console.log(response);
      if (response.statusText !== "OK") {
        const error = new Error({
          message: "Error while registering, Try Again",
        });
        throw error;
      }

      const { token, ...user } = response.data.profile;

      localStorage.setItem("token", token);
      context.commit("loginState", { token, user });

      router().push("/");
    } catch (error) {
      Loading.hide();
      console.log("error", error);
      Notify.create({
        type: "negative",
        message: "Error while registering, Try Again",
      });
    }
    Loading.hide();
  },
};
