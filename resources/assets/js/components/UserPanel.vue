<template>
  <div id="panel">
    <div class="col-md-offset-1 col-md-10 col-md-offset-1">
      <div class="user-panel">
        <div class="alert alert-success">
          Здравствуйте, {{ this.$root.user.name }}! <br />
          Вы успешно авторизовались как пользователь.
        </div>
        <form>
          <button class="btn btn-default btn-block" @click.prevent="logout()">ВЫЙТИ</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import toastr from 'toastr';
import '../api';

export default {
  name: 'panel',
  methods: {
    logout() {
      this.$http.post('/logout').then(
        (response) => {
          this.$root.loading = false;
          this.$root.user = false;
          toastr.success('Вы успешно вышли');
          return window.location.replace("/");
        },
        (error) => {
          this.$root.loading = false;
          toastr.error('Произошла ошибка при попытке logout', 'Error #62');
        }
      );      
    },    
  },
};
</script>

<style scoped>
.user-panel {
  margin-bottom: 15px;
}
</style>