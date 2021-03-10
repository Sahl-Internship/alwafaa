const coursesRoutes = [
  {
    path: '/courses',
    component: () => import('src/modules/courses/layout'),
    children: [
      {
        path: '',
        redirect: 'all'
      },
      {
        path: 'all',
        name: 'coursesList',
        component: () => import('src/modules/courses/pages/CoursesList.vue')
      }
    ]
  }
]
export default coursesRoutes
