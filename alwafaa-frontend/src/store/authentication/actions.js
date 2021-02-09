import { handleSignup } from 'src/services/authApi'

export default {
  async signup (context, user) {
    console.log(user)
    const response = await handleSignup(user)
    console.log(response)
  }
}
