import { axios } from 'src/boot/axios'

export const handleSignup = (userData) => {
  return axios({
    url: '',
    method: 'POST',
    userData
  })
}
