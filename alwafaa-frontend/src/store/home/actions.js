import { axios } from 'src/boot/axios'
export default {
  async getCourses (context) {
    const response = await axios.get('http://endpoints.alwafaa.localhost/course')
    context.commit('getCourses', response.data)
  }
}
