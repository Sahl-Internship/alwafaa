import { axios } from 'src/boot/axios'

export const handleSignup = (userData) => {
  return axios({
    url: 'http://endpoints.alwafaa.localhost/signup',
    method: 'POST',
    userData
  })
}
