<template>
  <app-layout title="Hero Build">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Show build: {{ build.name }}
      </h1>
    </template>
    <build-calculator 
      :build="build" 
      :hero="hero" 
      mode="show" 
      :talents="talents"
      :userIsOwner="userIsOwner"
    ></build-calculator>
    <div v-if="!userIsOwner" class="text-center mt-8">
      <upvote
        :build="build"
        :is-upvoted="isUpvoted"
        :is-authenticated="isAuthenticated"
        :number-of-upvotes="numberOfUpvotes"
      ></upvote>
    </div>
  </app-layout>
</template>

<script>
  import { Head, Link } from '@inertiajs/inertia-vue3';
  import BuildCalculator from '../../Components/BuildCalculator/BuildCalculator.vue';
  import Upvote from '../../Components/Upvote.vue';
  import AppLayout from '../../Layouts/AppLayout.vue';

  export default {
    components: {
      Head,
      Link,
      BuildCalculator,
      Upvote,
      AppLayout
    },
    props: [
      'build',
      'hero',
      'talents',
      'isUpvoted',
      'isAuthenticated',
      'numberOfUpvotes',
      'userIsOwner'
    ],
    methods: {
      handleDeleteBuild() {
        this.$inertia.delete(`/heroes/${this.hero.id}/builds/${this.build.id}`);
      }
    }
  }
</script>