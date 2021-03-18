import { Loading } from 'quasar'

import {
  handleCoursePage,
  handleCourseReview,
  handleGetCourses
} from 'src/services/coursesApi'

export default {
  async getCourses ({ commit }) {
    Loading.show()
    try {
      const response = await handleGetCourses()
      console.log('all', response.data)
      if (response.statusText !== 'OK') {
        const errorMessage = 'Error'
        const err = new Error(errorMessage)
        throw err
      }

      commit('getCourses', response.data)
      Loading.hide()
      return true
    } catch (error) {
      Loading.hide()
      console.log(error)
      return false
    }
  },
  async courseReview (context, review) {
    try {
      const response = await handleCourseReview(review)
      console.log(response)
      console.log(review)
    } catch (error) {
      console.log(error)
      console.log('review', review)
    }
    context.commit('courseReview', review)
  },
  async coursePage (context, courseId) {
    const response = await handleCoursePage(courseId)
    console.log(response.data)
    context.commit('getCoursePage', response.data)
  }
}
