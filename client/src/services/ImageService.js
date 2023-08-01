import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://localhost:8000', // Replace with your backend URL
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json'
    }
});

export default {
    getSignedUrl(key) {
        return apiClient.get(`/signed-url/${key}`) // Include filename in the endpoint
    },
    getImages() {
        return apiClient.get('/images') // Replace with your images endpoint
    },
    uploadImage(image) {
        let formData = new FormData();
        formData.append('image', image);
        return apiClient.post('/images', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }) // Replace with your image upload endpoint
    },
    login(credentials) {
        return apiClient.post('/login', credentials) // Replace with your login endpoint
    },
    register(user) {
        return apiClient.post('/register', user) // Replace with your registration endpoint
    }
}
