import { axiosInstance as axios } from 'src/boot/axios'

export const handleGetCourses = () => {
  return axios.get('http://endpoints.alwafaa.localhost/course/index')
}
