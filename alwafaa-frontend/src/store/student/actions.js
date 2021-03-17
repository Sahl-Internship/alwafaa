import { Notify, Loading } from 'quasar'
import { i18n } from 'src/boot/i18n'

import {
  handleEditData,
  handleJoinCourse,
  handleEditImgs,
  handleGetJoindCourses
} from 'src/services/studentApi'

export default {
  async editStudentData (context, studentData) {
    Loading.show()

    try {
      const response = await handleEditData(studentData)
      if (response.data.status !== 1) {
        console.log(response)
        throw new Error()
      }

      const { token, ...user } = response.data.profile
      localStorage.setItem('token', token)
      localStorage.setItem('user', JSON.stringify(user))
      context.commit('auth/loginState', { token, user }, { root: true })
      context.commit('toggleEditDialog')

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

  async editProfileAndCoverImg (context, image) {
    Loading.show()

    try {
      const response = await handleEditImgs(image)
      console.log(response)

      if (response.data.status !== 1) {
        throw new Error()
      }

      const { token, ...user } = response.data.profile
      localStorage.setItem('token', token)
      localStorage.setItem('user', JSON.stringify(user))
      context.commit('auth/loginState', { token, user }, { root: true })

      Loading.hide()
    } catch (error) {
      Loading.hide()

      Notify.create({
        type: 'negative',
        message: i18n.t('student.notification.editdataErr')
      })
    }
  },

  async joinCourse ({ rootGetters }, courseId) {
    Loading.show()

    try {
      const data = {
        user_id: rootGetters['auth/getUser'].id,
        course_id: courseId
      }

      const response = await handleJoinCourse(data)
      if (response.data.status !== 1) {
        console.log(response)
        throw new Error()
      }

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

  async getJoinedCourses ({ commit }) {
    Loading.show()
    try {
      const response = await handleGetJoindCourses()
      console.log('joined', response.data)
      if (response.statusText !== 'OK') {
        const err = new Error('error')
        throw err
      }

      commit('geJoinedtCourses', response.data)
      Loading.hide()
      return true
    } catch (error) {
      Loading.hide()
      console.log(error)
      return false
    }
  }
}
