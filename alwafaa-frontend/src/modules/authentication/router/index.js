const authRoutes = [
  {
    path: "/signup",
    name: "signup",
    component: () => import("src/modules/authentication/pages/Signup.vue"),
    meta: { requiresUnAuth: true },
  },
  {
    path: "/login",
    name: "login",
    component: () => import("src/modules/authentication/pages/Login.vue"),
    meta: { requiresUnAuth: true },
  },
  {
    path: "/forgotPass",
    name: "forgotPass",
    component: () =>
      import("src/modules/authentication/pages/ForgotPassword.vue"),
    meta: { requiresUnAuth: true },
  },
  {
    path: "/reset-pass",
    name: "resetPass",
    component: () =>
      import("src/modules/authentication/pages/ResetPassword.vue"),
  },
];
export default authRoutes;
