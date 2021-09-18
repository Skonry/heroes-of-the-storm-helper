<template>
  <app-layout title="TierLists">
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight">
          Tier Lists
      </h1>
    </template>
    <div class="flex flex-col items-center">
      <div v-if="$page.props.user">
        <Link :href="route('tier_lists.create')" class="btn btn-primary">Create tier list</Link>
      </div>
      <table class="table-fixed">
        <thead>
          <tr>
            <th scope="col" class="w-1/2">Tier List Name</th>
            <th scope="col" class="w-1/4">Upvotes</th>
            <th scope="col" class="w-1/4">Updated At</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr v-for="tierList in tierLists" class="even:bg-gray-200">
            <td class="border border-black p-2">
              <p>
                <Link :href="route('tier_lists.show', [tierList.id])">{{ tierList.name }}</Link>
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