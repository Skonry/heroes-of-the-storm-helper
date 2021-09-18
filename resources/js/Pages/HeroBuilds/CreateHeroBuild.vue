<template>
  <app-layout title="Create Hero Build">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Create build
      </h1>
    </template>
    <build-calculator :hero="hero" mode="create" :talents="talents"></build-calculator>
  </app-layout>
</template>

<script>
  import { Head, Link } from '@inertiajs/inertia-vue3';
  import BuildCalculator from '../../Components/BuildCalculator/BuildCalculator.vue';
  import AppLayout from '../../Layouts/AppLayout.vue';

  export default {
    components: {
      Head,
      Link,
      BuildCalculator,
        AppLayout
    },
    props: ['hero', 'talents']
  }
</script>