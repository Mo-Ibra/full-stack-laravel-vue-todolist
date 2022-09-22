<script>

import axios from 'axios';
import AddItemForm from './components/AddItemForm.vue';
import ListView from './components/ListView.vue';

export default {
  data: function () {
    return {
      items: [],
      loading: true,
    }
  },
  methods: {
    getList() {
      axios.get('http://localhost:8000/api/items')
        .then(response => {
          console.log(response.data);
          this.$data.items = response.data;
          this.$data.loading = false;
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  created() {
    this.getList();
  },
  components: {
    AddItemForm,
    ListView,
  },
}

</script>

<template>
  <div v-if="loading">
    <h2>Loading...</h2>
  </div>
  <div v-else>
    <ListView :items="this.$data.items" v-on:renderList="getList()" />
  </div>
  <AddItemForm v-on:renderList="getList()" />
</template>