<template>
  <div id="home">
     <stream :items="this.$root.streamItems"></stream> 
  </div>
</template>

<script>
import stream from '../components/Stream';
export default {
  name: 'home',
  components: {
    'stream': stream,
  },
};
</script>
