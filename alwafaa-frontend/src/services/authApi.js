import { axios } from 'src/boot/axios'

export const handleSignup = (data) => {
  return axios({
    url: 'http://endpoints.alwafaa.localhost/signup',
    method: 'POST',
    data
  })
}
