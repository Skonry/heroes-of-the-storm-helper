<template>
  <app-layout title="Heroes">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
          Heroes
      </h1>
    </template>
    <div class="grid grid-cols-auto-fill-100px justify-center gap-4">
      <div v-for="hero in heroes" :key="hero.id">
        <Link :href="route('heroes.builds.index', [hero.id])">
          <img 
            :src="hero.iconUrl" 
            :alt="hero.name"
            class="w-[100px] h-[100px]"
          >
        </Link>
      </div>
    </div>
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
    props: ['heroes']
  }
</script>