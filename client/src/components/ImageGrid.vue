<template>
  <div class="image-grid">
    <div v-for="image in images" :key="image.id" class="image-item">
      <img :src="image.url" :alt="image.title">
      <h2>Hello There!</h2>
      <p>{{ image.description }}</p>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

import ImageService from '@/services/ImageService'

export default {
  data() {
    return {
      images: []
    }
  },
  created() {
    ImageService.getImages()
        .then(response => {
          this.images = response.data.map(image => {
            // Check that the image has a filename property
            if (!image.id) {
              console.error('Image does not have a filename property:', image)
            } else {
              // Get the signed URL for each image
              ImageService.getSignedUrl(image.title)
                  .then(response => {
                    // Replace the image URL with the signed URL
                    image.url = response.data.url
                  })
                  .catch(error => {
                    console.error(error)
                  })
            }
            return image
          })
        })
        .catch(error => {
          console.error(error)
        })

  }
}

</script>

<style scoped>
.image-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  grid-gap: 20px;
}
.image-item {
  border: 1px solid #ddd;
  padding: 10px;
}
.image-item img {
  width: 100%;
  height: auto;
}
</style>
