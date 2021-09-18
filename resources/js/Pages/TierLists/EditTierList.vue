<template>
  <app-layout title="Edit Tier List">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
          Edit tier list: {{ tierList.name}}
      </h1>
    </template>
    <tier-list
      :heroes="heroes"
      mode="edit"
      :tier-list="tierList"
    ></tier-list>
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
    props: ['heroes', 'tierList']
  }
</script>