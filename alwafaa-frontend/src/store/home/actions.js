import { axiosInstance as axios } from 'src/boot/axios'

export default {
  async getCourses (context) {
    const response = await axios.get('http://endpoints.alwafaa.localhost/course')
    context.commit('getCourses', response.data)
    console.log('from action', response.data)
  }
  // async getHigherRate (context) {
  //   const response = await axios.get('http://endpoints.alwafaa.localhost/course')
  //   const data = response.data
  //   const rating = data.rate.filter(rate => rate === 4 || 4.5)
  //   context.commit('getHigherRate', rating)
  // }
}
