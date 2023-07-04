<template>

<div class="container">
  <header>
    <div class="px-3 py-2 bg-dark text-white">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <router-link to="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
            Products
          </router-link>
          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            
            <li>
                <router-link to="/" class="nav-link text-white" style="text-decoration: none; color: white;">Home</router-link>
            </li>
            
            <li>
                <router-link to="/login" v-if="!switchData"  class="nav-link text-white" style="text-decoration: none; color: white;">Login</router-link>
            </li>
            <li>
                <router-link to="/register" v-if="!switchData" class="nav-link text-white" style="text-decoration: none; color: white;">Register</router-link>
            </li>
            <li>
                <router-link to="/products/create" v-if="switchData" class="nav-link text-white" style="text-decoration: none; color: white;">Add Product</router-link>
            </li>
            <li>
                <button @click="logout" mode="flat" v-if="switchData" class="nav-link text-white btn btn-link" style="text-decoration: none; color: white;">Logout</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <div class="card">
    <div class="card-body">
      <div class="container-fluid">
        <router-view ></router-view>
      </div>
    </div>
  </div>
</div>
</template>
<script>
  import User from '../user.js';

export default {
  name: 'App',
   data() {
    
    return {
      switchData: User.loggedIn()
    }
  },
    mounted() {

      console.log("mounteddd");

},
  methods: {
   
    logout() {
      User.logOut()
      /* you should call "checkLogged" method after logout or login or signup to check the state of "local-storage" each time */
      this.checkLogged();
      this.$router.push('/login');

    },
    checkLogged() {
      /* instead of returning "true" or "false", change the value of "switchData" to benefit from Vue "reactivity"  */
      if(User.loggedIn()) {
        this.switchData = true;
      } else {
        this.switchData = false;
      }
      console.log(this.switchData)
    },
    loginMethod() {
      User.login(token);
      /* you should call "checkLogged" method after logout or login or signup to check the state of "local-storage" each time */
      this.checkLogged();
    }
  }
}
</script>