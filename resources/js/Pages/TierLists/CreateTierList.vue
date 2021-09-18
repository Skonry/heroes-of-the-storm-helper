<template>
  <app-layout title="Create Tier List">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
          Create Tier List
      </h1>
    </template>
    <tier-list :heroes="heroes" mode="create"></tier-list>
  </app-layout>
</template>

<script>
  import { Head } from '@inertiajs/inertia-vue3';
  import AppLayout from '../../Layouts/AppLayout.vue';
  import TierList from '../../Components/TierListCalculator/TierListCalculator.vue';

  export default {
    components: {
      Head,
      AppLayout,
      TierList
    },
    props: ['heroes']
  }
</script>