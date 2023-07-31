<template>
  <div>
    <h1>Upload Image</h1>
    <form @submit.prevent="onSubmit">
      <input type="file" @change="onFileChange">
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      selectedFile: null
    }
  },
  methods: {
    onFileChange(e) {
      this.selectedFile = e.target.files[0];
    },
    onSubmit() {
      let formData = new FormData();
      formData.append('image', this.selectedFile, this.selectedFile.name);
      axios.post('http://localhost:8000/api/upload', formData)
          .then(res => console.log(res))
          .catch(err => console.log(err));
    }
  }
}
</script>
