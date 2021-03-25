import { Notify, Loading } from 'quasar'
import { i18n } from 'src/boot/i18n'

import {
  handleGetUserData,
  handleEditData,
  handleJoinCourse,
  handleEditImgs,
  handleGetProfileData
} from 'src/services/studentApi'

export default {
  async getProfileData ({ commit }) {
    Loading.show()

    try {
      const response = await handleGetProfileData()
      console.log('joined', response)
      if (response.statusText !== 'OK') {
        const err = new Error('error')
        throw err
      }

      const profileInfo = {
        ...response.data,
        data: {
          ...response.data.data,
          image: response.data.data.image === 'http://backend.alwafaa.localhost/img/anonymous.jpg'
            ? '/images/user.jpg' : response.data.data.image
        }
      }

      commit('getProfileData', profileInfo)
      Loading.hide()
    } catch (error) {
      Loading.hide()
      console.log(error)
    }
  },

  async getUserData ({ commit }) {
    Loading.show()

    try {
      const response = await handleGetUserData()
      console.log('all user data', response)

      if (response.statusText !== 'OK') {
        const err = new Error('error')
        throw err
      }

      const userInfo = {
        ...response.data,
        image: response.data.image === 'http://backend.alwafaa.localhost/img/anonymous.jpg'
          ? '/images/user.jpg' : response.data.image
      }

      commit('getUserData', userInfo)
      Loading.hide()
      return true
    } catch (error) {
      Loading.hide()
      console.log(error)
      return false
    }
  },

  async editStudentData ({ commit, dispatch }, studentData) {
    Loading.show()

    try {
      const response = await handleEditData(studentData)
      console.log('after edit', response)

      if (response.data.status !== 1) {
        console.log('after edit', response)
        throw new Error()
      }

      dispatch('setStudentData', response.data.profile)
      commit('toggleEditDialog')

      Loading.hide()
      Notify.create({
        type: 'positive',
        message: i18n.t('student.notification.editDataSuccess')
      })
    } catch (error) {
      Loading.hide()

      Notify.create({
        type: 'negative',
        message: i18n.t('student.notification.editdataErr')
      })
    }
  },

  async editProfileAndCoverImg ({ dispatch }, image) {
    Loading.show()

    try {
      const response = await handleEditImgs(image)

      if (response.data.status !== 1) {
        throw new Error()
      }

      dispatch('setStudentData', response.data.profile)
      Loading.hide()
    } catch (error) {
      Loading.hide()

      Notify.create({
        type: 'negative',
        message: i18n.t('student.notification.editdataErr')
      })
    }
  },

  async joinCourse ({ rootGetters, dispatch }, courseId) {
    Loading.show()

    try {
      const data = {
        course_id: courseId
      }

      const response = await handleJoinCourse(data)
      dispatch('getProfileData')
      if (response.data.status !== 1) {
        console.log(response)
        throw new Error()
      }

      dispatch('getProfileData')
      Loading.hide()

      Notify.create({
        type: 'positive',
        message: i18n.t('student.notification.joinCourseSuccess')
      })
    } catch (error) {
      Loading.hide()

      Notify.create({
        type: 'negative',
        message: i18n.t('student.notification.joinCourseErr')
      })
    }
  },

  setStudentData ({ commit }, data) {
    const { token, ...user } = data
    const basicUserInfo = {
      id: user.id,
      firstname: user.firstname,
      lastname: user.lastname,
      email: user.email,
      image: user.image === 'http://backend.alwafaa.localhost/img/anonymous.jpg'
        ? '/images/user.jpg' : user.image
    }

    localStorage.setItem('token', token)
    localStorage.setItem('user', JSON.stringify(basicUserInfo))
    commit('auth/loginState', { token, user: basicUserInfo }, { root: true })
    commit('student/getUserData', user, { root: true })
  }
}
