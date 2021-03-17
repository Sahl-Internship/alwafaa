
import {
  handleCoursePage,
  handleCourseReview
} from 'src/services/coursesApi'

export default {
  async getCourses (context, studentData) {
  },
  async courseReview (context, review) {
    const response = await handleCourseReview(review)
    console.log(response)
    context.commit('courseReview', review)
  },
  async coursePage (context, courseId) {
    const response = await handleCoursePage(courseId)
    console.log(response.data)
    context.commit('getCoursePage', response.data)
  }
}
