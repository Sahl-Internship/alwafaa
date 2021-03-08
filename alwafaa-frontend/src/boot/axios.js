import Vue from 'vue'
import axios from 'axios'

const token = localStorage.getItem('token')

const axiosInstance = axios.create({
  // baseURL: 'https://some-domain.com/api/',
  headers: { Authorization: `Bearer ${token}` }
})

Vue.prototype.$axios = axiosInstance

export { axiosInstance }
