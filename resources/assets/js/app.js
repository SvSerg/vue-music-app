import Vue from 'vue';
import toastr from 'toastr';
import router from './router';
import './api';

import Player from './components/Player';
import Loading from './components/Loading';
import SearchStream from './components/SearchStream';
import RegisterPanel from './components/RegisterPanel';
import Playlist from './components/Playlist';
import UserPanel from './components/UserPanel';


Vue.component('vue-player', Player);
Vue.component('v-loading', Loading);
Vue.component('v-search', SearchStream);
Vue.component('v-user', RegisterPanel);
Vue.component('v-playlist', Playlist);
Vue.component('v-userpanel', UserPanel);

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
