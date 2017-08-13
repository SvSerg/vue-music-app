<template>
<div id="stream">
  <div class="stream-item" v-for="(item, key) in this.items" :key="key">
    Lexeech <span class="grey">posted</span> a track <span class="grey">3 days ago</span><br />
    <div class="media">
      <!-- image -->
      <div class="media-left">
        <a href="#">
          <img class="media-object" :src="item.img" :alt="item.performer">
        </a>
      </div>
      <!-- body  -->
      <div class="media-body">
        <h4 class="media-heading">{{ item.track_name }}</h4>
        by <a href="" class="a">{{ item.performer }}</a><br /><br />
        <small>
          {{ item.body }}
        </small>
        <div class="stream-buttons">
          <span @click="changeTrack(key, true)">play</span>
          <span>like</span>
          <span v-if="!this.user" @click="addInPlaylist(item)">add in playlist</span>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import toastr from 'toastr';
import '../api';

export default {
  name: 'stream',
  props: ['items'],
  methods: {
    changeTrack(id, autoload, trackList = this.$props.items) {
      // do not be scared , nothing else .
      return this.$root.$children[0].changeTrack(id, autoload, trackList);
    },
    addInPlaylist({ id, performer, track_name }) {
      this.$http.post('/api/playlist/add', { id: id }).then(
        (response) => {
          toastr.info(`${performer} - ${track_name} добавлен в ваш плейлист!`);
          
          //? update playlist
          this.$root.$children[8].fetchList();
        },
        (error) => {
          toastr.error('Произошла ошибка при попытки добавления песни в плейлист', 'Error #31');
        }
      );
    },
  }
};
</script>