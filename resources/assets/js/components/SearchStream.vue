<template>
  <div id="search">
    <div class="col-md-12">
      <error-list :errors="this.errors" v-if="this.errors != 0"></error-list>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <div class="col-md-12">
            <input type="text" class="form-control" placeholder="Введите текст .." v-model="input">
          </div>
        </div>
        <button @click.prevent="search()" class="btn btn-default">НАЙТИ</button>
      </form>

      <div class="text-center" v-if="this.hasSearch">
        Найдено <span class="a">{{ this.total }}</span>
        <span v-if="this.total > 5 || this.total === 0"> соответствий.</span>
        <span v-if="this.total < 5 && this.total !== 0"> соответствие.</span><br />
        <router-link :to="{ name: 'FoundItemsPage', params: {search: this.input} }">
          <span v-if="this.total">Перейти по <span class="a">ссылке &rarr;</span></span>
        </router-link>
        
      </div>
    </div>
  </div>
</template>

<script>
import api from '../api';
import ErrorList from '../components/ErrorList';

export default {
  name: 'search',
  components: { 'error-list': ErrorList },
  data() {
    return {
      hasSearch: false,
      input: '',
      total: null,
      errors: [],
    };
  },
  methods: {
    search() {
      this.$root.loading = true;

      const options = { search: this.input };
      this.$http.post('/api/stream/count-search', options).then(
        response => {
          this.$root.loading = false;

          this.errors = [];
          this.total = response.data;
          this.hasSearch = true;
        },
        error => {
          this.$root.loading = false;
          this.errors = error.data;
        }
      );

    },
  },
};
</script>