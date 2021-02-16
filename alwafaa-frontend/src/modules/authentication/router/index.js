const authRoutes = [{
    path: "/signup",
    name: "signup",
    component: () => import("src/modules/authentication/pages/Signup.vue"),
  },
  {
    path: "/login",
    name: "login",
    component: () => import("src/modules/authentication/pages/Login.vue"),
  },
  {
    path: "/forgotPass",
    name: "forgotPass",
    component: () =>
      import("src/modules/authentication/pages/ForgotPassword.vue"),
  },
  {
    path: '/reset-pass',
    name: 'resetPass',
    component: () => import('src/modules/authentication/pages/ResetPassword.vue')
  }
];
export default authRoutes;
