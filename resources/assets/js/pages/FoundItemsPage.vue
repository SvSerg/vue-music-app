<template>
  <div id="found-items">
    <div class="well">
      Ответ по запросу <span class="a">'{{ this.$route.params.search }}'</span>:
    </div>
    <stream :items="this.items"></stream> 
  </div>
</template>

<script>
import api from '../api';
import stream from '../components/Stream';

export default {
  name: 'found-items',
  components: {
    'stream': stream,
  },
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    this.$root.loading = true;

    const options = { search: this.$route.params.search };
    this.$http.post('/api/stream/search', options).then(
      response => {
        this.$root.loading = false;
        this.items = response.data;
      },
      error => {
        this.$root.loading = false;
        toastr.error('Ошибка при попытки загрузить найденные данные.', 'Error #45')
      }
    );
  },
};
</script>