<template>
  <div class="max-w-2xl mx-auto">
    <div class="flex my-4">
      <div>Level</div>
      <div class="flex-1 text-center">Talents</div>
    </div>
    <div v-for="level in levels" class="flex">
      <span class="self-center">{{ level }}</span>
      <TalentsRow :talents="talentsInRow(level)" class="flex-1"/>
    </div>
  </div>
</template>

<script>
    import TalentsRow from './TalentsRow.vue';
    
    export default {
        components: {
            TalentsRow
        },
        props: [
            'talents'
        ],
        data() {
          return {
            levels: [1, 4, 7, 10, 13, 16, 20]
          };
        },
        methods: {
          talentsInRow(level) {
            return this.talents.filter((talent) => talent.level == level);
          }
        }
    }
</script>