<template>
  <div class="image-grid">
    <div v-for="image in images" :key="image.id" class="image-item">
      <img :src="image.url" :alt="image.title">
      <h2>{{ image.title }}</h2>
      <p>{{ image.description }}</p>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  name: 'ImageGrid',
  computed: {
    ...mapState(['images'])
  },
  created() {
    this.fetchImages()
  },
  methods: {
    ...mapActions(['fetchImages'])
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
