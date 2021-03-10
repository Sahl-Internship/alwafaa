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
      context.commit('toggleEditDialog')

      Loading.hide()
      Notify.create({
        type: 'positive',
        message: i18n.t('student.notification.editDataSuccess')
      })
    } catch (error) {
      Loading.hide()

      Notify.create({
        type: 'negative',
        message: i18n.t('student.notification.editdataErr')
      })
    }
  }
}
