import { axiosInstance as axios } from 'src/boot/axios'

export const handleGetProfileData = () => {
  return axios.get('http://endpoints.alwafaa.localhost/profile/joined-courses')
}

export const handleGetUserData = () => {
  return axios.get('http://endpoints.alwafaa.localhost/profile/data')
}

export const handleEditData = (data) => {
  return axios.put('http://endpoints.alwafaa.localhost/profile/update', data)
}

export const handleEditImgs = (data) => {
  return axios.put('http://endpoints.alwafaa.localhost/profile/upload-picture', data)
}

export const handleJoinCourse = (data) => {
  return axios.post('http://endpoints.alwafaa.localhost/join-course/join-course', data)
}
