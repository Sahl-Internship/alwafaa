const authRoutes = [{
    path: "/signup",
    name: "signup",
    component: () => import("src/modules/authentication/pages/Signup.vue"),
    meta: {
      requiresUnAuth: true
    },
  },
  {
    path: "/login",
    name: "login",
    component: () => import("src/modules/authentication/pages/Login.vue"),
    meta: {
      requiresUnAuth: true
    },
    props: true,
  },
  {
    path: "/forgotPass",
    name: "forgotPass",
    component: () =>
      import("src/modules/authentication/pages/ForgotPassword.vue"),
    meta: {
      requiresUnAuth: true
    },
  },
  {
    path: "/reset-password",
    name: "resetPass",
    component: () =>
      import("src/modules/authentication/pages/ResetPassword.vue"),
    props: true,
  },
];
export default authRoutes;
