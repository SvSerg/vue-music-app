<template>
  <div id="user">
    <error-list :errors="this.errors" v-if="this.errors != 0"></error-list>
    <div class="col-md-offset-1 col-md-10 col-md-offset-1">
      <form v-if="!this.registration">
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Введите e-mail .." v-model="login.email">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Введите пароль .." v-model="login.password">
        </div>
        <button class="btn btn-default btn-block" @click.prevent="signin()">ВОЙТИ</button>
        <br />
        <span class="cursor" @click="registration = !registration">У вас нет аккаунта? <span class="a">Зарегистрируйтесь</span></span>
      </form>

      <form v-if="this.registration">
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Введите e-mail .." v-model="register.email">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Введите nickname .." v-model="register.name">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Введите пароль .." v-model="register.password">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Повторить пароль .." v-model="register.passwordConfirm">
        </div>
        <button class="btn btn-default btn-block" @click.prevent="signup()">ЗАРЕГИСТРИРОВАТЬСЯ</button>
        <br />
        <span class="cursor" @click="registration = !registration">У вас есть аккаунт? <span class="a">Авторизируйтесь</span></span>
      </form>

    </div>
  </div>
</template>

<script>
/*
* TODO:
* 1. Сделать выход
* 2. Уведомления о успешности входа и регистрации
*/
import '../api';
import ErrorList from '../components/ErrorList';

export default {
  name: 'user',
  components: { 'error-list': ErrorList },
  data() {
    return {
      registration: false,
      errors: [],
      login: {
        email: '',
        password: '',
      },
      register: {
        email: '',
        name: '',
        password: '',      
        passwordConfirm : '',      
      },
    };
  },
  methods: {
    signin() {
      const options = {
        email: this.login.email,
        password: this.login.password,
      };
      this.$http.post('/login', options).then(
        (response) => {
          return window.location.replace("/");
        },
        (error) => {
          global.console.log(error.data);
          this.errors = error.data;
        }
      );
    },
    signup() {
      const options = {
        email: this.register.email,
        name: this.register.name,
        password: this.register.password,
        password_confirmation: this.register.passwordConfirm,
      };
      this.$http.post('/register', options).then(
        (response) => {
          return window.location.replace("/");
        },
        (error) => {
          global.console.log(error.data);
          this.errors = error.data;
        }
      );
    },
  }
};
</script>

<style>
  #user {
    display: block;
    padding-top: 20px;
    clear: both;
  }
</style>