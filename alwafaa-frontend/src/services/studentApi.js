import { axiosInstance as axios } from 'src/boot/axios'

export const handleEditData = (data) => {
  return axios.put('http://endpoints.alwafaa.localhost/profile/update', data)
}
