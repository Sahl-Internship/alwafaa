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
        let errorMessage = i18n.t('authNotification.registerdefaultError')

        if (response.data.key === 'dataError') {
          const messages = Object.keys(response.data.message)
          const errors = messages.map(
            (item) => i18n.t(item) + i18n.t('authNotification.notvalid')
          )
          errorMessage = errors.join(', ')
        }

        const error = new Error(errorMessage)
        throw error
      }

      this.$router.push({ name: 'login' })

      Notify.create({
        type: 'positive',
        message: i18n.t('authNotification.registerSuccess')
      })
    } catch (error) {
      Loading.hide()

      const message = error.message
      Notify.create({
        type: 'negative',
        message: message && message !== 'Network Error'
          ? message
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
        const errorMessage = response.data.key
          ? i18n.t(`authNotification.${response.data.key}`)
          : i18n.t('authNotification.DefaultError')

        const err = new Error(errorMessage)
        throw err
      }

      const { token, ...user } = response.data.profile
      const userInfo = {
        ...user,
        image: user.image === 'http://backend.alwafaa.localhost/img/anonymous.jpg'
          ? '/images/user.jpg' : user.image
      }

      localStorage.setItem('token', token)
      localStorage.setItem('user', JSON.stringify(userInfo))

      context.commit('loginState', {
        token,
        user: userInfo
      })

      this.$router.push({ name: 'home' })
    } catch (error) {
      Loading.hide()

      const message = error.message
      Notify.create({
        type: 'negative',
        message: message && message !== 'Network Error'
          ? message
          : i18n.t('authNotification.DefaultError')
      })
    }

    Loading.hide()
  },

  async forgotPassword (context, email) {
    Loading.show()

    try {
      const response = await handleForgotPass(email)
      if (response.data.status !== 1) {
        const errorMessage = response.data.message.email
          ? i18n.t('authNotification.verfiyEmailError')
          : i18n.t('authNotification.DefaultError')

        const err = new Error(errorMessage)
        throw err
      }

      Notify.create({
        type: 'positive',
        message: i18n.t('authNotification.verfiyEmailSucess')
      })
    } catch (error) {
      Loading.hide()

      const message = error.message
      Notify.create({
        type: 'negative',
        message: message && message !== 'Network Error'
          ? message
          : i18n.t('authNotification.DefaultError')
      })
    }

    Loading.hide()
  },

  async resetPassword (context, { password, token }) {
    Loading.show()

    try {
      const response = await handleResetPassword({ password }, token)
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

      const message = error.message
      Notify.create({
        type: 'negative',
        message: message && message !== 'Network Error'
          ? message
          : i18n.t('authNotification.DefaultError')
      })
    }
    Loading.hide()
  },

  logout ({ commit }) {
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    commit('logout')
    this.$router.push({ name: 'login' })
  }
}
