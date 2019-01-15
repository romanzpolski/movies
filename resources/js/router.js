import VueRouter from 'vue-router'
// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Search from './pages/Search'
import Movie from './pages/Movie'
import PageNotFound from './pages/404'

// Routes
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: undefined
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    // USER ROUTES
    {
        path: '/search/:query',
        name: 'searchWithQuery',
        component: Search,
        meta: {
            auth: true
        }
    },
    {
        path: '/search/',
        name: 'search',
        component: Search,
        meta: {
            auth: true
        }
    },
    {
        path: '/movie/:id',
        name: 'movie',
        component: Movie,
        meta: {
            auth: true
        }
    },
    // 404
    {
        path: '*',
        name: '404',
        component: PageNotFound,
        meta: {
            auth: false
        }
    },

]

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

export default router
