import { Notify, Loading } from 'quasar'
import { i18n } from 'src/boot/i18n'

import {
  handleSignup,
  handleLogin,
  handleForgotPass,
  handleResetPassword
} from 'src/services/authApi'

export default {
  async signup (context, user) {
    Loading.show()

    try {
      const response = await handleSignup(user)
      if (response.data.status !== 1) {
        const messages = Object.keys(response.data.message)
        // const errors = messages.map((item) => `${item} not valid`);
        const errors = messages.map(
          (item) => i18n.t(item) + i18n.t('authNotification.notvalid')
        )
        const errorMessage = errors.join(', ')
        const error = new Error(errorMessage)
        throw error
      }

      this.$router.push({ name: 'login' })

      Notify.create({
        type: 'positive',
        // message: "You registered successfully, confirm your email to login",
        message: i18n.t('authNotification.registerSuccess')
      })
    } catch (error) {
      Loading.hide()

      Notify.create({
        type: 'negative',
        message: error.message
          ? error.message
          : i18n.t('authNotification.registerdefaultError')
      })
    }

    Loading.hide()
  },
  async login (context, userData) {
    Loading.show()
    try {
      const response = await handleLogin(userData)

      if (response.data.status !== 1) {
        // const err = new Error(response.data.message);
        const err = new Error(i18n.t('authNotification.loginError'))
        throw err
      }

      const { token, ...user } = response.data.profile
      localStorage.setItem('token', token)
      context.commit('loginState', {
        token,
        user
      })

      this.$router.push({
        name: 'home'
      })
    } catch (error) {
      Loading.hide()

      Notify.create({
        type: 'negative',
        message: error.message ? error.message : 'Invalid Data'
      })
    }
    Loading.hide()
  },
  async forgotPassword (context, email) {
    Loading.show()

    try {
      const response = await handleForgotPass(email)

      if (response.data.status !== 1) {
        const err = new Error(i18n.t('authNotification.verfiyEmailError'))
        throw err
      }
      // this.$router.push({ name: 'login' })

      Notify.create({
        type: 'positive',
        message: i18n.t('authNotification.verfiyEmailSucess')
      })
    } catch (error) {
      Loading.hide()
      Notify.create({
        type: 'negative',
        message: error.message ? error.message : 'Error, Try Again'
      })
    }
    Loading.hide()
  },
  async resetPassword (context, password) {
    const { token } = this.$router.app._route.query
    Loading.show()

    try {
      const response = await handleResetPassword(password, token)

      if (response.data.status !== 1) {
        const err = new Error(i18n.t('authNotification.resetError'))
        throw err
      }

      this.$router.push({ name: 'login' })

      Notify.create({
        type: 'positive',
        message: i18n.t('authNotification.resetSuccess')
      })
    } catch (error) {
      Loading.hide()

      Notify.create({
        type: 'negative',
        message: error.message ? error.message : 'Error While reset, Try Again'
      })
    }
    Loading.hide()
  },
  logout ({ commit }) {
    commit('logout')
    localStorage.removeItem('token')
    this.$router.push({ name: 'login' })
  }
}
