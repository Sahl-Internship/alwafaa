const studentRoutes = [
  {
    path: "/profile",
    component: () => import("src/modules/student/pages/ProfileNavigation.vue"),
    // meta: {
    //   requiresAuth: true
    // },
    children: [
      {
        path: "/profile/my_courses",
        component: () => import("src/modules/student/pages/MyCourses.vue"),
        meta: {
          requiresAuth: true,
        },
      },
      {
        path: "/profile/pre-courses",
        component: () => import("src/modules/student/pages/PreCourses.vue"),
        meta: {
          requiresAuth: true,
        },
      },
    ],
  },
];
export default studentRoutes;
