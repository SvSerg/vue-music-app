<template>
  <div id="errors">
    <div class="wall-danger">
      <span v-for="item in this.errors">- {{ item[0] }}<br /></span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'errors',
  props: [ 'errors' ]
};
</script>

<style>
  .wall-danger {
    background-color: #b30000 !important;
    color: white;
    font-size: 10px;
    padding: 15px;
    margin: 15px 0;
  }
</style>