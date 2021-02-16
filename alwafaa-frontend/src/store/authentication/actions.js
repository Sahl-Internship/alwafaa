import {
  handleSignup,
  handleLogin
} from "src/services/authApi";

export default {
  async signup(context, user) {
    console.log(user)
    try {
      const response = await handleSignup(user)
      console.log(response)
    } catch (error) {
      console.log('error')
      console.log(error)
    }
  },
  async login(context, user) {
    console.log(user);
    try {
      const response = await handleLogin(user);
      console.log(response);
      const token = response.data.token;
      console.log('token', token);
      console.log('data', response.data)
      localStorage.setItem('access_token', token)
      context.commit('loginState', token)
    } catch (error) {
      console.log('error')
      console.log(error)
    }
  },
  async resetPass(context, password) {
    try {
      const response = await handleResetPass(password)
      console.log(response)
    } catch (error) {
      console.log('error')
      console.log(error)
    }
  },
};
