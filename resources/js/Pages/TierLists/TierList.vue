<template>
  <app-layout title="Tier List">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Tier list name: {{ tierListName }}
      </h1>
    </template>
    <p class="mt-8">Tiers:</p>
    <div class="mt-8">
      <div v-for="tier in tiers">
        <div >
          {{ tier.name }}
        </div>
        <div :style="{minHeight: '102px'}" class="flex flex-wrap border border-black">
            <img :src="hero.heroIconUrl" class="w-[100px] h-[100px]" v-for="hero in tier.heroes">
        </div>
      </div>
    </div>
    <div v-if="userIsOwner">
      <Link 
        :href="route('tier_lists.edit', [tierListId])"
        class="mr-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
      >
        Edit tier list
      </Link>
      <button 
        @click="handleDeleteTierList"
        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
      >
        Delete tier list
      </button>
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
    props: ['tierListName', 'tierListId', 'tiers', 'userIsOwner'],
    methods: {
      handleDeleteTierList() {
        this.$inertia.delete(`/tier_lists/${tierListId}`);
      }
    }
  }
</script>