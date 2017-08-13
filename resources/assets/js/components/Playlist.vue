<template>
  <div id="list">
    <div class="col-md-offset-1 col-md-10 col-md-offset-1" v-if="this.items.length >= 1">
      <div class="media" v-for="(item, key) in this.items" :key="key">
        <!-- image -->
        <div class="media-left">
          <img class="playlist-image cursor" @click="changeTrack(key, true)" :src="item.img" :alt="item.performer">
        </div>
        <!-- body  -->
        <div class="media-body">
          <span class="grey">{{ item.performer }}</span><br />
          <span>{{ item.track_name }}</span>
        </div>
      </div><br />
      <div class="text-center">
        В списке всего <span class="a">{{ this.items.length }}</span> 
        <span v-if="this.items.length === 5">песен</span>
        <span v-if="this.items.length <= 4 && this.items.length !== 1">песни</span>
        <span v-if="this.items.length === 1">песня</span>
      </div>
      <button class="btn btn-default btn-block">показать весь список</button>
    </div>
  </div>
</template>

<script>
import '../api';

export default {
  name: 'list',
  data() {
    return {
      items: [],
    };
  },
  methods: {
    changeTrack(id, autoload, trackList = this.items) {
      return this.$root.$children[0].changeTrack(id, autoload, trackList);
    },
    fetchList(limit = 5) {
      if(this.$root.user) {
        this.$http.post('/api/playlist/get', { limit: limit }).then(
          (response) => {
            // update array
            this.items = [];

            // fix array data ..
            for (let i = 0; i < response.data.length; i++) {
              this.items.push(response.data[i][0]);
            }
          }
        );
      }
    }
  },
  mounted() {
    this.fetchList(5);
  }
};
</script>

<style scoped>
.playlist-image {
  width: 50px !important;
  height: 50px !important;
}
button {
  margin-top: 15px;
}
</style>