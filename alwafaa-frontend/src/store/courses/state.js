export default () => {
  return {
    token: localStorage.getItem('token'),
    courses: [],
    course: {},
    rate: '',
    review: '',
    rank: ''
  }
}
