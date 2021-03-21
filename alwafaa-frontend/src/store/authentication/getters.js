export default {
  isAuthenticated (state) {
    return !!state.token
  },
  getUser (state) {
    return state.user || JSON.parse(localStorage.getItem('user'))
  },
  getToken (state) {
    return state.token
  }
}
