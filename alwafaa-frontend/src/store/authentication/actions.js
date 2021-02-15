import { handleSignup, handleLogin } from "src/services/authApi";

export default {
  async signup(context, user) {
    console.log(user);
    try {
      const response = await handleSignup(user);
      console.log(response);
    } catch (error) {
      console.log("error");
      console.log(error);
    }
  },
  async login(context, user) {
    console.log(user);
    const response = await handleLogin(user);
    console.log(response);
    const token = response.data.access_token;
    localStorage.setItem("access_token", token);
    context.commit("loginState", token);
  },
};
