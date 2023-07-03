<template>
  <div>
    <h2 v-if="isNewProduct">Add Product</h2>
    <h2 v-else>Edit Product</h2>
      <form @submit.prevent="submitForm">
        <div  v-if="errormessage != ''" class="alert alert-danger" role="alert">
          {{ errormessage }}
        </div>
        <div  v-for="(error, key) in errors" :key="key" class="alert alert-danger" role="alert">
          {{ error[0] }}
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input class="form-control" type="text" id="name" v-model="product.name" required />
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description:</label>
          <textarea class="form-control" id="description" v-model="product.description" required></textarea>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price:</label>
          <input class="form-control" type="number" id="price" v-model="product.price" required />
        </div>
        <button type="submit" v-if="isNewProduct" class="btn btn-primary">Add Product</button>
        <button type="submit" v-else class="btn btn-primary">Update Product</button>
      </form>
  </div>
</template>

<script>
import User from '../user.js';
import axios from 'axios';
export default {
  data() {
    return {
      errormessage : '',
      errors : [],
      product: {
        name: '',
        description: '',
        price: 0
      },
      config: { headers: { "Content-type": "application/json", Authorization: 'Bearer '+User.getToken() }},
    }
  },
  computed: {
    isNewProduct() {
      return !this.$route.path.includes('edit');
    }
  },
  async created() {
    if (!this.isNewProduct) {
      try {
        const response = await axios.get(`/api/products/${this.$route.params.id}`, this.config);
        this.product = response.data.product;
      } catch (error) {
        if(error.response.data.errors){
          this.errors = error.response.data.errors;
        } else if(error.response.data.message){
          this.errormessage = error.response.data.message;
        }
      }
    }
  },
  methods: {
    async submitForm() {
      try {
        if (this.isNewProduct) {
          await axios.post('/api/products', this.product, this.config);
        } else {
          await axios.put(`/api/products/${this.$route.params.id}`, this.product, this.config);
        }
        this.$router.push('/');
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
</script>