export default function () {
  return {
    user: null || JSON.parse(localStorage.getItem('user')),
    token: null || localStorage.getItem('token')
  }
}
