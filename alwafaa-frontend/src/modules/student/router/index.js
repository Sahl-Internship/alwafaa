const studentRoutes = [
  {
    path: '/student',
    component: () => import('src/modules/student/layout'),
    children: [
      {
        path: '',
        redirect: 'profile'
      },
      {
        path: 'profile',
        name: 'studentProfile',
        component: () => import('src/modules/student/pages/Profile.vue'),
        meta: {
          requiresAuth: true
        }
      }
    ]
  }
]
export default studentRoutes
