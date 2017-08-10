import Vue from 'vue';
import toastr from 'toastr';
import router from './router';
import Player from './components/Player';
import Loading from './components/Loading';
import SearchStream from './components/SearchStream';
import UserPanel from './components/UserPanel';
import './api';

Vue.component('vue-player', Player);
Vue.component('v-loading', Loading);
Vue.component('v-search', SearchStream);
Vue.component('v-user', UserPanel);

new Vue({
  el: '#app',
  router,
  data: {
    loading: false,
    user: Laravel.user,
    streamItems: []
  },
  mounted() {
    this.loading = true;
    this.$http.post('/api/stream/get').then(
      response => {
        this.loading = false;
        this.streamItems = response.data;
      },
      error => {
        this.loading = false;
        toastr.error('Неудалось загрузить страницу', 'Error #23');
      }
    );
  }
});
