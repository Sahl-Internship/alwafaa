import { handleSignup } from 'src/services/authApi'

export default {
  async signup (context, user) {
    console.log(user)
    try {
      const response = await handleSignup(user)
      console.log(response)
    } catch (error) {
      console.log('error')
      console.log(error)
    }
  }
}
