<template>
  <div class="btn-group">
    <button
      type="button"
      class="btn btn-primary dropdown-toggle"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      Wiadomośći
      <span class="badge badge-light">9</span>
      <span class="sr-only">unread messages</span>
    </button>
    <div class="dropdown-menu dropdown-menu">
      <div class="col-12">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt placeat ipsum illo necessitatibus, ea cumque! Fugiat dignissimos a inventore minus.</p>
      </div>
    </div>
  </div>
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

<style>
  .dropdown-menu {
    max-height :300px;
    overflow-x: hidden;
    min-width: 20rem;
  }
</style>