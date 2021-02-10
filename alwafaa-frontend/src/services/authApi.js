import {
  axios
} from 'src/boot/axios'

export const handleLogin = (userData) => {
  return axios({
    url: '/login',
    method: 'POST',
    userData
  })
}
export const handleSignup = (userData) => {
  return axios({
    url: '',
    method: 'POST',
    userData
  })
}
