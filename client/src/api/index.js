import axios from 'axios'

const apiClient = axios.create({
    baseURL: 'http://localhost:3000', // TODO: Replace with your backend URL
    withCredentials: false,
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json'
    }
})

export default {
    getImages() {
        return apiClient.get('/images') // TODO: Replace with your endpoint
    },
    uploadImage(image) {
        return apiClient.post('/images', image) // TODO: Replace with your endpoint
    },
    login(credentials) {
        return apiClient.post('/login', credentials) // TODO: Replace with your endpoint
    },
    register(user) {
        return apiClient.post('/register', user) // TODO: Replace with your endpoint
    }
}
