import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://localhost:8000', // Replace with your backend URL
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json'
    }
});

export default {
    getImages() {
        return apiClient.get('/images')
    }
}
