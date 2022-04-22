import { createRouter, createWebHistory } from 'vue-router'; 

import Landing from './pages/Landing';  
import Register from './pages/Register'; 
import Login from './pages/Login'; 
import Dashboard from './pages/Dashboard'; 

const router = createRouter({  
    history: createWebHistory(),  
    routes: [  
        {  
            name: 'landing',  
            path: '/',  
            component: Landing,  
        },  
        {  
            name: 'register',  
            path: '/register',  
            component: Register,  
        },
        {  
            name: 'login',  
            path: '/login',  
            component: Login,  
        },
        {  
            name: 'dashboard',  
            path: '/dashboard',  
            component: Dashboard,  
        },  
    ],  
});  
export default router;