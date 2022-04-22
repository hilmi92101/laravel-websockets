import { createRouter, createWebHistory } from 'vue-router'; 

import Landing from './pages/Landing';  
import Register from './pages/Register'; 
import Login from './pages/Login'; 
import Dashboard from './pages/Dashboard'; 
import Post from './pages/Post'; 

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
        {  
            name: 'post',  
            path: '/posts/:id',  
            component: Post,  
        },  
    ],  
});  
export default router;