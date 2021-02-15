export default {
  loginState(state, authedUser) {
    console.log(authedUser);
    state.token = authedUser.token;
    state.user = authedUser.user;
  },
};
