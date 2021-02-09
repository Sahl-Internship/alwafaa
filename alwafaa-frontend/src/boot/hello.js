import hello from 'hellojs'

export default ({ Vue }) => {
  hello.init({
    facebook: '239154534469533',
    google: '17907567904-fr5gbrvjp2uuv296lsir7b10j8le7k4e.apps.googleusercontent.com'
  })
  Vue.prototype.$hello = hello
}
