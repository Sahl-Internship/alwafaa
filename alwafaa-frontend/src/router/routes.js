import authRoutes from "src/modules/authentication/router";
import studentRoutes from "src/modules/student/router";

const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { path: "home", component: () => import("pages/Home.vue") },
      ...authRoutes,
      ...studentRoutes,
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "*",
    component: () => import("pages/Error404.vue"),
  },
];

export default routes;
