<template>
  <div id="app">
    <CatList />
    <AddCatForm />
  </div>
</template>

<script>
import CatList from './components/CatList.vue';
import AddCatForm from './components/AddCatForm.vue';

export default {
  name: 'App',
  components: {
    CatList,
    AddCatForm
  }
}
</script>
