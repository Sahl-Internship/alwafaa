const authRoutes = [{
    path: '/signup',
    component: () => import('src/modules/authentication/pages/Signup.vue')
  },
  {
    path: '/login',
    component: () => import('src/modules/authentication/pages/Login.vue')
  },
  {
    path: '/forgotPass',
    component: () => import('src/modules/authentication/pages/ForgotPassword.vue')
  },
  {
    path: '/reset-pass',
    component: () => import('src/modules/authentication/pages/ResetPassword.vue')
  }
]
export default authRoutes
