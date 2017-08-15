<template>
  <div id="random">
    <div class="col-md-offset-1 col-md-10 col-md-offset-1 random">
      <span class="grey">Случайные песни:</span>
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import toastr from 'toastr';
import '../api';

export default {
  name: 'random',
  data() {
    return {
      items: [],
    };
  },
  methods: {
    changeTrack(id, autoload, trackList = this.items) {
      return this.$root.$children[0].changeTrack(id, autoload, trackList);
    }
  },
  mounted() {
    this.$http.post('/api/playlist/get-random', { limit: 5 }).then(
      (response) => {
        this.items = response.data;
      },
      (error) => {
        toastr.error('Произошла ошибка при попытки загрузить рандом-список', 'Error #54');
      }
    );
  }
};
</script>

<style scoped>
.random {
  margin-top: 15px;
}
.playlist-image {
  width: 50px !important;
  height: 50px !important;
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