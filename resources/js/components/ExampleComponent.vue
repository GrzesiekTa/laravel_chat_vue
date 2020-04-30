<template>
  <button type="button" class="btn btn-primary">
    Profile
    <span class="badge badge-light">9</span>
    <span class="sr-only">unread messages</span>
  </button>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },

  created() {},

  methods: {
    test: function() {
      console.log("test");
    }
  }
};
</script>
