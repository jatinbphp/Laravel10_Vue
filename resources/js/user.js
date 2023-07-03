export default {
    hasToken() {
        const storeToken = localStorage.getItem('token');

        if (storeToken) {
            return true;
        }
        return false;
    },

    loggedIn() {
        return this.hasToken();
    },

    getToken() {
        return localStorage.getItem('token');
    },
    logOut() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
    },

    /* I created this method to simulate the login of user. maybe you set "token" in other parts of your code. */
    login(token) {
        console.log("logged in");
        localStorage.setItem("token", token);
    }
}