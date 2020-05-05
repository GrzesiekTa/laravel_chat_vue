<template>
  <div class="main">
    <loading v-if="$root.loading"></loading>
    <div class="container-fluid">
      <NavigationComponent />
      <transition name="fade">
        <router-view></router-view>
      </transition>
    </div>
  </div>
</template>
<style>
</style>
<script>
import NavigationComponent from "./components/NavigationComponent.vue";
export default {
  components: {
    NavigationComponent
  }
};
</script>