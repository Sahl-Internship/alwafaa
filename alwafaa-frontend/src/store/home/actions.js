import {
  handleGetCourses
} from 'src/services/coursesApi'

export default {
  async getCourses (context) {
    const response = await handleGetCourses()
    context.commit('getCourses', response.data)
    console.log(response.data)
    // return response
  }
}
