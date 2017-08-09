<template>
  <div id="player">
		<div class="player" v-show="showPlayer">
			<div class="container">
				<ul>
					<li class="player-list player-buttons"><button class="glyphicon glyphicon-step-backward" @click="changeTrack(id - 1, true)" :disabled="this.id < 1"></button></li>

					<li class="player-list player-buttons" v-if="!this.play"><button class="glyphicon glyphicon-play" @click="start()"></button></li>

					<li class="player-list player-buttons" v-if="this.play"><button class="glyphicon glyphicon-pause" @click="stop()"></button></li>

					<li class="player-list player-buttons"><button class="glyphicon glyphicon-step-forward" @click="changeTrack(id + 1, true)" :disabled="this.id >= this.total"></button></li>

					<li class="player-list player-timer">
            <span class="a2">{{ this.currentTime2 }}</span> / {{ this.duration2 }}
          </li>
					<li class="player-progress">
            <input type="range" min="0" :max="this.duration" step="0.01" @change="changeCurrentTime(currentTime)" v-model="currentTime" />
          </li>
					<li class="player-volume">
          <input type="range" min="0" max="1" step="0.01" v-model.number="volume" />
          </li>
					<li class="player-list">
						<img :src="this.track.img" alt="." />
					</li>
					<li class="player-list player-track">
						<span>{{ track.performer }}</span><br />
						<small>{{ track.track_name }}</small>
					</li>
				</ul>
			</div>
		</div>    
    <audio :src="track.url" id="audio-player" @change="test()"></audio>
  </div>
</template>

<script>
import toastr from 'toastr';
function convertTimeHHMMSS(val) {
  try {
    const hhmmss = new Date(val * 1000).toISOString().substr(11, 8);
    return (hhmmss.indexOf('00:') === 0) ? hhmmss.substr(3) : hhmmss;    
  } catch (error) {
    toastr.info('Плеер загружается, подождите немного ...');
  }
}

export default {
  name: 'player',
	props: ['items'],
  data() {
    return {
      play: false,
      showPlayer: false,
      audio: [],
      id: 0,
      total: 0,
      volume: 100,
      currentTime: 0,
      duration: 0,
      heEnded: false,
      checkTimer: false,
      track: { id: 0, url: '' },
      tracks: [],
    };
  },
  computed: {
    duration2() {
      return convertTimeHHMMSS(this.duration);
    },
    currentTime2() {
      return convertTimeHHMMSS(this.currentTime);
    },
  },
  methods: {
    /*
    * start track and start interval for checking ended music
    */
    start() {
      document.getElementById('audio-player').currentTime = 0;
      this.duration = document.getElementById('audio-player').duration;
      this.checkTimer = setInterval(this.heEnd, 1000);

      this.play = true;
      this.showPlayer = true;
      document.getElementById('audio-player').play();
    },
    /*
    * stop track and clear interval
    */
    stop() {
      clearTimeout(this.checkTimer);
      this.checkTimer = false;
      this.currentTimeTimer = false;

      this.play = false;
      document.getElementById('audio-player').pause();
    },
    /*
    * change track from ID or auto
    */
    changeTrack(id, autoload = false, trackList) {
      // update track list
      if (trackList !== undefined) {
        this.tracks = trackList;
        this.total = trackList.length - 1;
      }
      
      this.duration = document.getElementById('audio-player').duration;
      this.currentTime = 0;

      clearTimeout(this.checkTimer);
      this.checkTimer = false;

      this.id = id;
      this.track = this.tracks[id];
  
      if (autoload) {
        setTimeout(this.start, 500);
      }
    },
    /*
    * CHECK TRACK ENDED
    */
    heEnd() {
      this.heEnded = document.getElementById('audio-player').ended;
      if (this.heEnded) {
        // if its last track go to first track.
        if (this.id >= this.total) this.changeTrack(0, true);
        // else next track.
        else this.changeTrack(this.id + 1, true);
      }
    },
    getCurrentTime() {
      this.currentTime = document.getElementById('audio-player').currentTime;
    },
    changeCurrentTime(value) {
      this.currentTime = value;
      document.getElementById('audio-player').currentTime = value;
    },
  },
  watch: {
    volume(newVolume) {
      document.getElementById('audio-player').volume = newVolume;
    },
  },
  mounted() {
    const that = this;
    document.getElementById('audio-player').ontimeupdate = () => that.getCurrentTime();

    setTimeout(function () {
      that.tracks = that.items;
      that.total = that.items.length - 1;
      that.track = that.items[0];      
    }, 1000);
  },
};
</script>

<style>
button[disabled], html input[disabled] {
  color: grey !important;
  opacity: .5;
}
</style>