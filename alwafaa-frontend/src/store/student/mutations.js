export default {
  getUserData (state, data) {
    state.studentData = data
  },
  toggleEditDialog (state) {
    state.editMode = !state.editMode
  },
  getProfileData (state, data) {
    state.studentData = data.data
    state.joinedCourses = data.courses
    state.activities = data.reviews
  }
}
