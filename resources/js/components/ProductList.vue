<template>
    <div  v-if="errormessage != ''" class="alert alert-danger" role="alert">
      {{ errormessage }}
    </div>
    <div  v-for="(error, key) in errors" :key="key" class="alert alert-danger" role="alert">
      {{ error[0] }}
    </div>
    <div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.price }}</td>
                    <td>
                      <div class="row gap-3">
                        <router-link :to="`/products/${product.id}`" class="p-2 col border btn btn-primary">View</router-link>
                        <router-link :to="`/products/${product.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>
                        <button @click="deleteProduct(product.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import User from '../user.js';
import axios from 'axios';
export default {
  data() {
    return {
      products: [],
      errormessage : '',
      errors : [],
      config: { headers: { "Content-type": "application/json", Authorization: 'Bearer '+User.getToken() }},
    }
  },
  async created() {
    try {
      this.errormessage = '';
      this.errors = [];
      const response = await axios.get('/api/products', this.config);
      this.products = response.data.products;
    } catch (error) {
       if(error.response.data.errors){
          this.errors = error.response.data.errors;
        } else if(error.response.data.message){
          this.errormessage = error.response.data.message;
        }
      console.error(error);
    }
  },
  methods: {
    async deleteProduct(id) {
      if(confirm("Are you sure?")) {
        try {
          this.errormessage = '';
          this.errors = [];
          await axios.delete(`/api/products/${id}`, this.config);
          this.products = this.products.filter(product => product.id !== id);
        } catch (error) {
          if(error.response.data.errors){
            this.errors = error.response.data.errors;
          } else if(error.response.data.message){
            this.errormessage = error.response.data.message;
          }
          console.error(error);
        }
      }
    }
  }
}
</script>