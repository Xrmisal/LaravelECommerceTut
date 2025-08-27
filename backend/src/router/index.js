import {createRouter, createWebHistory} from "vue-router"
import Dashboard from "../views/Dashboard.vue"
import Login from "../views/Login.vue"
import RequestPassword from "../views/PasswordRequest.vue"
import store from '../store'
import AppLayout from '../components/AppLayout.vue'
import Products from '../views/Products/Products.vue'
import notFound from '../views/notFound.vue'

const routes = [
    {
        path: '/',
        redirect: '/app'
    },
    {
        path: '/app',
        name: 'app',
        component: AppLayout,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/dashboard',
                name: 'app.dashboard',
                component: Dashboard
            },
            {
                path:'/products',
                name: 'app.products',
                component: Products
            }
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/request-password',
        name: 'request-password',
        component: RequestPassword,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/request-password/:token',
        name: 'request-password-token',
        component: RequestPassword,
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/:pathMatch(.*)',
        name: 'NotFound',
        component: notFound
    }
]

const router = createRouter( {
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({name: 'login'})
    } else if (to.meta.requiresGuest && store.state.user.token) {
        next({name: 'app.dashboard'})
    } else {
        next()
    }
})

export default router