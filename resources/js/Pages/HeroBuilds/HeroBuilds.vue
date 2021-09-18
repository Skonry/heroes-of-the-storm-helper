<template>
  <app-layout title="Hero Builds">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ hero.name }}'s builds
      </h1>
    </template>
    <div class="flex flex-col items-center">
      <div>
        <img :src="heroIconUrl" :alt="hero.name" class="w-[100px] h-[100px]">
      </div>
      <div v-if="$page.props.user">
        <Link :href="route('heroes.builds.create', [hero.id])" class="underline text-blue-500">
          Create new build
        </Link>
      </div>
      <table class="table-fixed">
        <thead>
          <tr>
            <th scope="col" class="w-1/2">Build Name</th>
            <th scope="col" class="w-1/4">Upvotes</th>
            <th scope="col" class="w-1/4">Updated At</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr v-for="build in builds" class="even:bg-gray-200">
            <td class="border border-black p-2">
              <p>
                <Link :href="route('heroes.builds.show', [hero.id, build.id])" class="underline text-blue-500">{{ build.name }}</Link>
              </p>
              <p>
                by 
                <a>{{ build.userName }}</a>
              </p>
            </td>
            <td class="border border-black p-2">{{ build.upvotesCount }}</td>
            <td class="border border-black p-2">{{ build.updatedAt }}</td>
          </tr>
        </tbody>
      </table>
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
    props: [
      'hero',
      'builds',
      'heroIconUrl'
    ]
  }
</script>