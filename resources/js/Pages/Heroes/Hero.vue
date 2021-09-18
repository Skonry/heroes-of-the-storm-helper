<template>
  <app-layout title="Hero">
  </app-layout>
</template>

<script>
  import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '../../Layouts/AppLayout.vue';

  export default {
    components: {
      Head,
      Link,
      AppLayout,
    },
    props: ['hero', 'heroIconUrl']
  }
</script>
