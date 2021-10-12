<template>
  <app-layout title="TierLists">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
          Tier Lists
      </h1>
    </template>
    <div class="flex flex-col items-center">
      <div v-if="$page.props.user">
        <Link 
          :href="route('tier_lists.create')" 
          class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
        >
          New tier list
        </Link>
      </div>
      <table v-if="tierLists.length !== 0" class="mt-8 table-fixed">
        <thead>
          <tr>
            <th scope="col" class="w-1/2">Tier List Name</th>
            <th scope="col" class="w-1/4">Upvotes</th>
            <th scope="col" class="w-1/4">Updated At</th>
          </tr>
        </thead>
        <tbody class="bg-white text-center">
          <tr v-for="tierList in tierLists" class="even:bg-gray-200">
            <td class="border border-black p-2">
              <p>
                <Link :href="route('tier_lists.show', [tierList.id])" class="underline text-blue-500">{{ tierList.name }}</Link>
              </p>
              <p>
                by 
                <a>{{ tierList.userName }}</a>
              </p>
            </td>
            <td class="border border-black p-2">{{ tierList.upvotesCount }}</td>
            <td class="border border-black p-2">{{ tierList.updatedAt }}</td>
          </tr>
        </tbody>
      </table>
      <p v-else class="mt-8">
        No tier lists yet.
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
      AppLayout,
    },
    props: ['tierLists']
  }
</script>