import axios from 'axios';

export default {
    get(url, request = {}) {
        return axios.get(url, request);
    },
    post(url, body, request = {}) {
        return axios.post(url, body, request);
    },
    // Add other HTTP methods as needed (put, delete, etc.)
};
