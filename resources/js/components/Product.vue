<template>
    <div>
        <div  v-if="errormessage != ''" class="alert alert-danger" role="alert">
          {{ errormessage }}
        </div>
        <div  v-for="(error, key) in errors" :key="key" class="alert alert-danger" role="alert">
          {{ error[0] }}
        </div>
        <div>
        <h5 id="associating-form-text-with-form-controls">Name:</h5>
        <h6>{{ product.name }}</h6>
        <h5 id="associating-form-text-with-form-controls">Description:</h5>
        <p>{{ product.description }}</p>
        <h5 id="associating-form-text-with-form-controls">Price:</h5>
        <p>Price: {{ product.price }}</p>
        <router-link :to="`/products/${product.id}/edit`" class="btn btn-primary">Edit</router-link>
    </div>
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
        product: {},
        config: { headers: { "Content-type": "application/json", Authorization: 'Bearer '+User.getToken() }},
    }
},
async created() {
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
}
</script>