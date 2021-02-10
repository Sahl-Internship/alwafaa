import {
  axios
} from 'src/boot/axios'

export const handleLogin = (userData) => {
  return axios({
    url: 'http://endpoints.alwafaa.localhost/site/login',
    method: 'POST',
    userData
  })
}
export const handleSignup = (userData) => {
  return axios({
    url: 'http://endpoints.alwafaa.localhost/signup',
    method: 'POST',
    userData
  })
}
