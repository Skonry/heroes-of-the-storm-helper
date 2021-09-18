<template>
  <app-layout title="Edit Hero Build">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit build: {{ build.name }}
      </h1>
    </template>
    <build-calculator 
      :build="build" 
      :hero="hero" 
      :talents="talents"
      mode="edit" 
    ></build-calculator>
  </app-layout>
</template>

<script>
  import { Head } from '@inertiajs/inertia-vue3';
  import BuildCalculator from '../../Components/BuildCalculator/BuildCalculator.vue';
  import AppLayout from '../../Layouts/AppLayout.vue';

  export default {
    components: {
      Head,
      BuildCalculator,
        AppLayout
    },
    props: [
      'build',
      'hero',
      'talents'
    ]
  }
</script>