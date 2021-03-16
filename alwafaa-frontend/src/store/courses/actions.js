
import {
  handleCourseReview
} from 'src/services/coursesApi'

export default {
  async getCourses (context, studentData) {
  },
  async courseReview (context, review) {
    const response = await handleCourseReview(review)
    console.log(response)
    context.commit('courseReview', review)
  }
}
