export default {
  getUserData (state) {
    return state.studentData
  },
  checkEditMode (state) {
    return state.editMode
  },
  profileData (state) {
    return {
      studentData: state.studentData,
      joinedCourses: state.joinedCourses,
      activities: state.activities
    }
  }
}
