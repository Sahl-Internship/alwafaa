<template>
  <q-page>
    <div class="form-container">
      <div class="login-show">
        <h2>LOGIN</h2>
        <input type="text" placeholder="Email" v-model="email" />
        <input type="password" placeholder="Password" v-model="password" />
        <input type="button" value="Login" />
        <a href="">Forgot password?</a>
        <hr />
        <h6>or use social</h6>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: ""
    };
  }
};
</script>
<style scoped>
.form-container {
  background: #234957;
  width: 50%;
  height: 800px;
  overflow: hidden;
}
.login-show {
  /* background: #e6ecf5; */
  background: #fff;
  box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.5);
  width: 80%;
  margin: 0px 10%;
  margin-top: 100px;
  border-radius: 3px;
}
.login-show h2 {
  margin: 0px 10%;
  padding-top: 20px;
  width: 80%;
}
.login-show input[type="text"],
.login-show input[type="password"] {
  width: 80%;
  display: block;
  margin: 20px 10%;
  padding: 15px;
  outline: none;
}

.login-show input[type="text"]:focus,
.login-show input[type="password"]:focus {
  border: 1px solid #e05a36;
}

.login-show input[type="button"] {
  width: 80%;
  margin: 20px 10%;
  padding: 15px;
  background: #e05a36;
  color: #f9f9f9;
  border: none;
  outline: none;
  text-transform: uppercase;
  border-radius: 2px;
  cursor: pointer;
}
.login-show a {
  display: block;
  width: 80%;
  margin: 0 10%;
  text-decoration: none;
  color: #e05a36;
}
hr {
  width: 80%;
  margin: 0 10%;
}
h6 {
  text-align: center;
  font-size: 14px;
  color: #c7bfbf;
}
</style>
