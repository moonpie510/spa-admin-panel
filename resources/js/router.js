import {createRouter, createWebHistory} from 'vue-router'

const routes = [
    {path: '/admin/dashboard', component: () => import('./components/Dashboard.vue'), name: 'admin.dashboard'},
    {path: '/admin/appointments', component: () => import('./pages/appointments/ListAppointments.vue'), name: 'admin.appointments'},
    {path: '/admin/users', component: () => import('./pages/users/ListUsers.vue'), name: 'admin.users'},
    {path: '/admin/settings', component: () => import('./pages/settings/UpdateSettings.vue'), name: 'admin.settings'},
    {path: '/admin/profile', component: () => import('./pages/profile/UpdateProfile.vue'), name: 'admin.profile'},

]

const router = createRouter({
    history: createWebHistory(),
    //linkActiveClass: 'active',
    routes,
});

export default router;
