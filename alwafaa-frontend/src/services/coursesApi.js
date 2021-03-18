import { axiosInstance as axios } from 'src/boot/axios'

export const handleGetCourses = () => {
  return axios.get('http://endpoints.alwafaa.localhost/course/index')
}

export const handleCourseReview = (review) => {
  return axios.post('http://endpoints.alwafaa.localhost/join-course/review', review)
}

export const handleCoursePage = (courseId) => {
  return axios.post(`http://endpoints.alwafaa.localhost/course/view?id=${courseId}`)
}
