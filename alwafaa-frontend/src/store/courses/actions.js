import { Loading } from 'quasar'

import { handleGetCourses } from 'src/services/coursesApi'

export default {
  async getCourses ({ commit }) {
    Loading.show()
    try {
      const response = await handleGetCourses()
      console.log(response)
      if (response.statusText !== 'OK') {
        const errorMessage = 'Error'
        const err = new Error(errorMessage)
        throw err
      }

      commit('getCourses', response.data)
      Loading.hide()
    } catch (error) {
      Loading.hide()
      console.log(error)
    }
  }
}
