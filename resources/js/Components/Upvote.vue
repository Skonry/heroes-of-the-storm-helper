<template>
  <div>
    <div v-if="isAuthenticated">
      <p v-if="isUpvotedData">
        Build is already upvoted
      </p>
      <button v-else @click="handleUpvote">Upvote build</button>
    </div>
    <div>
      <p>Number of upvotes: {{ numberOfUpvotesData }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    'build',
    'numberOfUpvotes',
    'isAuthenticated',
    'isUpvoted'
  ],
  data() {
    return {
      numberOfUpvotesData: this.numberOfUpvotes,
      isUpvotedData: this.isUpvoted
    }
  },
  methods: {
    handleUpvote() {
      this.numberOfUpvotesData++;
      this.isUpvotedData = true;
      axios.post(`/builds/${this.build.id}/upvotes`)
        .then(response => {
          console.log('upvoted build');
        });
    }
  }
}
</script>