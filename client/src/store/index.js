import Vue from 'vue'
import Vuex from 'vuex'

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
        fetchImages({ commit }) {
            // TODO: Make API call to fetch images and commit the result
        },
        uploadImage({ commit }, image) {
            // TODO: Make API call to upload image and commit the result
        },
        login({ commit }, credentials) {
            // TODO: Make API call to authenticate user and commit the result
        },
        register({ commit }, user) {
            // TODO: Make API call to create user and commit the result
        }
    },
    modules: {}
})
