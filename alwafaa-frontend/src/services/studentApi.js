import { axiosInstance as axios } from 'src/boot/axios'

export const handleEditData = (data) => {
  return axios.put('http://endpoints.alwafaa.localhost/profile/update', data)
}

export const handleEditImgs = (data) => {
  return axios.put('http://endpoints.alwafaa.localhost/profile/upload-picture', data)
}

export const handleJoinCourse = (data) => {
  return axios.post('http://endpoints.alwafaa.localhost/course/join-course', data)
}
