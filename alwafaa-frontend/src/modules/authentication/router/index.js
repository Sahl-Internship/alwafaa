const authRoutes = [
  {
    path: "/signup",
    component: () => import("src/modules/authentication/pages/Signup.vue")
  },
  {
    path: "/login",
    component: () => import("src/modules/authentication/pages/Login.vue")
  }
];

export default authRoutes;
