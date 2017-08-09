<template>
  <div id="loading">
    <div class="loader-block">
      <div class="loader"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'loading',
};
</script>

<style>
  .loader-block {
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: #fff;
    opacity: 0.5;
    z-index: 9999;
  }

  .loader {
      margin: 22.5% auto;
      border: 8px solid lightgray;
      border-top: 8px solid black;
      border-radius: 50%;
      width: 68px;
      height: 68px;
      animation: spin 1s linear infinite;
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }
</style>
