<template>
  <div>
  
    <h2 >Login</h2>
      <form @submit.prevent="submitForm">

        <div  v-if="errormessage != ''" class="alert alert-danger" role="alert">
          {{ errormessage }}
        </div>
        <div  v-for="(error, key) in errors" :key="key" class="alert alert-danger" role="alert">
          {{ error[0] }}
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Email:</label>
          <input class="form-control" type="email" id="email" v-model="user.email" required />
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Password:</label>
          <input class="form-control" type="password" id="password" v-model="user.password" required />
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
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
      test : '1233544',
      errors : [],
      user: {
        email: '',
        password: ''
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
        const response =  await axios.post('/api/auth/login', this.user);
        User.login(response.data.token);
        this.$router.push('/');
        setTimeout(function () {
          window.location.reload();
        }, 100);

      } catch (error) {
        console.log(error);
         if(error.response.data.errors){
          this.errors = error.response.data.errors;
         } else if(error.response.data.message){
          this.errormessage = error.response.data.message;
         }
        console.error(error);
      }
    },
  
  
  }
}
</script>