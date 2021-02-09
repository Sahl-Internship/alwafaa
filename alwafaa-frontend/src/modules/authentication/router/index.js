const authRoutes = [
  {
    path: '/signup',
    component: () => import('src/modules/authentication/pages/Signup.vue')
  },
  {
    path: '/login',
    component: () => import('src/modules/authentication/pages/Login.vue'),
    childern: [
      { path: '/profile', component: () => import('src/modules/authentication/pages/profile.vue') }
    ]
  }
]
export default authRoutes
