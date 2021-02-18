export default {
  loginState(state, authedUser) {
    state.token = authedUser.token;
    state.user = authedUser.user;
  },
  logout(state) {
    state.token = null;
    state.user = null;
  },
};
