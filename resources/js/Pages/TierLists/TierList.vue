<template>
  <app-layout title="Tier List">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Tier list name: {{ tierListName }}
      </h1>
    </template>
    <div v-if="userIsOwner">
      <Link :href="route('tier_lists.edit', [tierListId])">Edit tier list</Link>
      <button @click="handleDeleteTierList">Delete tier list</button>
    </div>
    <p>Tiers</p>
    <div v-for="tier in tiers">
      <div >
        {{ tier.name }}
      </div>
      <div :style="{minHeight: '102px'}" class="flex flex-wrap border border-black">
          <img :src="hero.heroIconUrl" class="w-[100px] h-[100px]" v-for="hero in tier.heroes">
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
    props: ['tierListName', 'tierListId', 'tiers', 'userIsOwner'],
    methods: {
      handleDeleteTierList() {
        this.$inertia.delete(`/tier_lists/${tierListId}`);
      }
    }
  }
</script>