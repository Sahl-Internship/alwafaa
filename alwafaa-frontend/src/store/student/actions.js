import { Notify, Loading } from 'quasar'
import { i18n } from 'src/boot/i18n'

import {
  handleEditData
} from 'src/services/studentApi'

export default {
  async editStudentData (context, studentData) {
    console.log(studentData)
    Loading.show()

    try {
      const response = await handleEditData(studentData)
      if (response.data.status !== 1) {
        console.log(response)
        throw new Error()
      }

      const { token, ...user } = response.data.profile
      localStorage.setItem('token', token)
      localStorage.setItem('user', JSON.stringify(user))
      context.commit('auth/loginState', { token, user }, { root: true })

      Loading.hide()
      return true
    } catch (error) {
      Loading.hide()
      console.log(error)
      Notify.create({
        type: 'negative',
        message: i18n.t('student.otification.editdataErr')
      })
      return false
    }
  }
}
