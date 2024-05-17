import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../components/pages/dashboards/Dashboard.vue";
import UserList from "../components/pages/users/Index.vue";

const routes = [
    {
        path: '/home',
        component: Dashboard
    },
    {
        path: '/user',
        component: UserList
    }
]

const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router
