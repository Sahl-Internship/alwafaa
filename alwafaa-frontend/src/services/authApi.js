import { axios } from 'src/boot/axios'

export const handleLogin = (userData) => {
  return axios.post('http://endpoints.alwafaa.localhost/site/login', userData)
}
export const handleResetPass = (password) => {
  return axios.post('', password)
}

export const handleSignup = (data) => {
  return axios({
    url: 'http://endpoints.alwafaa.localhost/signup',
    method: 'POST',
    data
  })
}

export const handleForgotPass = (email) => {
  return axios.post(
    'http://endpoints.alwafaa.localhost/site/request-password-reset ',
    email
  )
}

export const handleResetPassword = (password, token) => {
  return axios.post(
    `http://endpoints.alwafaa.localhost/site/reset-password?token=${token}`,
    password
  )
}
