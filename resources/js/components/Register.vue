<template>
  <div>
  
    <h2 >User Register</h2>
      <form @submit.prevent="submitForm">
        <div  v-if="errormessage != ''" class="alert alert-danger" role="alert">
          {{ errormessage }}
        </div>
        <div  v-for="(error, key) in errors" :key="key" class="alert alert-danger" role="alert">
          {{ error[0] }}
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input class="form-control" type="text" id="name" v-model="user.name" required />
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Email:</label>
          <input class="form-control" type="text" id="email" v-model="user.email" required />
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Password:</label>
          <input class="form-control" type="password" id="password" v-model="user.password" required />
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Confirm Password:</label>
          <input class="form-control" type="password" id="password_confirmation" v-model="user.password_confirmation" required />
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      errormessage : '',
      errors : [],
      user: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  computed: {
    
  },
  async created() {
   
  },
  methods: {
    async submitForm() {
      try {
        this.errormessage = '';
        this.errors = [];
        await axios.post('/api/auth/register', this.user);
        
        this.$router.push('/login');
      } catch (error) {
        if(error.response.data.errors){
          this.errors = error.response.data.errors;
        } else if(error.response.data.message){
          this.errormessage = error.response.data.message;
        }
      }
    }
  }
}
</script>