import Api from '@/services/Api'

export default {
    upload (image) {
        let formData = new FormData()
        formData.append('image', image)
        return Api().post('image/upload', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
    },
    getAll () {
        return Api().get('image')
    }
}
