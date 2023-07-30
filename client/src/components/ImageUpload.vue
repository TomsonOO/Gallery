<template>
  <div class="image-upload">
    <form @submit.prevent="uploadImage">
      <input type="file" @change="onFileChange">
      <input type="text" v-model="title" placeholder="Title">
      <textarea v-model="description" placeholder="Description"></textarea>
      <button type="submit">Upload</button>
    </form>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'ImageUpload',
  data() {
    return {
      file: null,
      title: '',
      description: ''
    }
  },
  methods: {
    ...mapActions(['uploadImage']),
    onFileChange(e) {
      this.file = e.target.files[0]
    },
    uploadImage() {
      const formData = new FormData()
      formData.append('file', this.file)
      formData.append('title', this.title)
      formData.append('description', this.description)
      this.uploadImage(formData)
    }
  }
}
</script>

<style scoped>
.image-upload form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>
