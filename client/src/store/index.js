import Vue from 'vue'
import Vuex from 'vuex'
import AuthService from '../services/AuthService'
import ImageService from '../services/ImageService'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: null,
        images: []
    },
    mutations: {
        setUser(state, user) {
            state.user = user
        },
        setImages(state, images) {
            state.images = images
        }
    },
    actions: {
        async fetchImages({ commit }) {
            const response = await ImageService.getAll()
            commit('setImages', response.data)
        },
        async uploadImage({ commit }, image) {
            const response = await ImageService.upload(image)
            commit('setImages', [...this.state.images, response.data])
        },
        async login({ commit }, credentials) {
            const response = await AuthService.login(credentials)
            commit('setUser', response.data)
        },
        async register({ commit }, user) {
            const response = await AuthService.register(user)
            commit('setUser', response.data)
        }
    },
    modules: {}
})
