export default {
  getCourses (state, data) {
    state.courses = data
  },
  courseReview (state, review) {
    state.rate = review.rate
    state.comment = review.comment
    state.rank = review.rank
  }
}
