<template>
  <div>
    <h2>Add a New Cat</h2>
    <form @submit.prevent="submitForm">
      <label for="name">Name:</label>
      <input id="name" v-model="cat.name" required>

      <label for="age">Age:</label>
      <input id="age" v-model="cat.age" required>

      <!-- Add additional fields as needed -->

      <button type="submit">Add Cat</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cat: {
        name: '',
        age: ''
        // Add additional properties as needed
      }
    }
  },
  methods: {
    submitForm() {
      // make a POST request to the API
      fetch('http://localhost:8000/cats', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(this.cat)
      })
          .then(response => response.json())
          .then(data => {
            console.log(data);
            // handle the response from the API
          })
          .catch(error => {
            console.error('Error:', error);
            // handle the error
          });
    }
  }
}
</script>
