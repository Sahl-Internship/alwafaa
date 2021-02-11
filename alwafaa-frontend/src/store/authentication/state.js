export default function () {
  return {
    userId: null,
    token: null || localStorage.getItem('access_token')
  }
}
