import Vue from 'vue'
import VueRouter from 'vue-router'
import ImageGrid from '../components/ImageGrid.vue'
import ImageUpload from '../components/ImageUpload.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'ImageGrid',
        component: ImageGrid
    },
    {
        path: '/upload',
        name: 'ImageUpload',
        component: ImageUpload
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
