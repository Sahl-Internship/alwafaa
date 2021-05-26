import hello from 'hellojs'

export default ({ Vue }) => {
  hello.init({
    facebook: '203283204854912',
    google:
      '440324445473-usbgu90vkhbkvg3skib9kclfo00m4833.apps.googleusercontent.com'
  })
  Vue.prototype.$hello = hello
}
