<template>
  <div id="list">
    <div class="col-md-offset-1 col-md-10 col-md-offset-1" v-if="this.items.length >= 1">
      <span class="grey">Ваш плейлист:</span>
      <div class="media playlist" v-for="(item, key) in this.items" :key="key">
        <!-- image -->
        <div class="media-left">
          <img class="playlist-image cursor" @click="changeTrack(key, true)" :src="item.img" :alt="item.performer">
          <span class="glyphicon glyphicon-play" @click="changeTrack(key, true)"></span>
        </div>
        <!-- body  -->
        <div class="media-body">
          <span class="grey">{{ item.performer }}</span><br />
          <span>{{ item.track_name }}</span>
          <span class="close playlist-close" @click="deleteFromList(key, item)">&times;</span>
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
import toastr from 'toastr';
import '../api';

export default {
  name: 'list',
  data() {
    return {
      items: [],
      extend: [],
    };
  },
  methods: {
    deleteFromList(id, { performer, track_name }) {
      this.extend.splice(id, 1);
      this.$http.post('/api/playlist/update', { playlist: this.extend }).then(
        (response) => {
          toastr.info(`${performer} - ${track_name} удален из вашего плейлиста!`);
          this.fetchList();
        },
        (error) => {
          toastr.error('К сожалению произошла ошибка при попытки', 'Error #47');
        }
      );
      
    },
    changeTrack(id, autoload, trackList = this.items) {
      return this.$root.$children[0].changeTrack(id, autoload, trackList);
    },
    fetchList(limit = 5) {
      if(this.$root.user) {
        this.$http.post('/api/playlist/get', { limit: limit }).then(
          (response) => {
            // update array
            this.items = [];
            
            // save extend data
            this.extend = response.data.extend;

            // fix array data ..
            for (let i = 0; i < response.data.result.length; i++) {
              this.items.push(response.data.result[i][0]);
            }
          }
        );
      }
    }
  },
  mounted() {
    // 5 is limit
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

.playlist-close {
  display: none;
  
}

.playlist:hover .playlist-close {
  display: block;
}

.media-left {
  position: relative;
}

.glyphicon-play {
  cursor: pointer;
  color: black;
  opacity: .5;
  font-size: 24px;
  position: absolute;
  top: 12px;
  left: 15px;
  display: none;
  
}

.playlist:hover .glyphicon-play {
  display: block;
}

</style>