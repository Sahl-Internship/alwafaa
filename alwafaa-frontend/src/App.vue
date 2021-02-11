<template>
  <div id="q-app">
    <!-- <h3>Header Call</h3> -->
    <router-view />
  </div>
</template>
<script>
export default {
  name: "App",
};
</script>

<style lang="scss" scoped>
div {
  background-image: linear-gradient(to right, #fff, #f2f2f2);
}
</style>
