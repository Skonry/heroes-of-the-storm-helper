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
      <div v-if="$page.props.user" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mt-8">
        <Link :href="route('heroes.builds.create', [hero.id])">
          New build
        </Link>
      </div>
      <table v-if="builds.length !== 0" class="table-fixed mt-8">
        <thead>
          <tr>
            <th scope="col" class="w-1/2">Build Name</th>
            <th scope="col" class="w-1/4">Upvotes</th>
            <th scope="col" class="w-1/4">Updated At</th>
          </tr>
        </thead>
        <tbody class="bg-white text-center">
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
      <p v-else class="mt-8">
        No builds yet
      </p>
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
    AppLayout
  },
  props: [
    'hero',
    'builds',
    'heroIconUrl'
  ]
}
</script>