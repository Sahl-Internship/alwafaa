export default {
  toggleEditDialog (state) {
    state.editMode = !state.editMode
  },
  geJoinedtCourses (state, data) {
    state.joinedCourses = data
  }
}
