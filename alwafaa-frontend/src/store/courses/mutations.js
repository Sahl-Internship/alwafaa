export default {
  getCourses (state, data) {
    state.courses = data
  },
  courseReview (state, comment) {
    state.rate = comment.rate
    state.review = comment.review
  },
  getCoursePage (state, course) {
    state.course = course
  }
}
