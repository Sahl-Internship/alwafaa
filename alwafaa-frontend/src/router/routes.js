import authRoutes from 'src/modules/authentication/router'
import studentRoutes from 'src/modules/student/router'
import coursesRoutes from 'src/modules/courses/router'

const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '',
        name: 'home',
        component: () => import('src/modules/home/page/Home.vue')
      },
      {
        path: 'home',
        redirect: '/'
      },
      ...studentRoutes,
      ...coursesRoutes
    ]
  },
  ...authRoutes,

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
