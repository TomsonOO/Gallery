<template>
  <div>
    <ul>
      <li v-for="cat in cats" :key="cat.id">
        {{ cat.name }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cats: []
    };
  },
  mounted() {
    fetch("http://localhost:8000/cats")
        .then(response => response.json())
        .then(data => {
          this.cats = data;
        });
  }
};
</script>
