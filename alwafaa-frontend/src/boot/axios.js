import Vue from 'vue'
import axios from 'axios'
import store from '../store/index.js'

console.log(store)
// const token = localStorage.getItem('token')
// const token = store()..getters['auth/getToken']

const axiosInstance = axios.create({
  // baseURL: 'https://some-domain.com/api/',
  // headers: { Authorization: `Bearer ${token}` }
})

axiosInstance.interceptors.request.use((request) => {
  const token = localStorage.getItem('token')

  if (token) {
    request.headers.Authorization = `Bearer ${token}`
  }

  return request
})

Vue.prototype.$axios = axiosInstance

export { axiosInstance, axios }
