<template>
  <div>
    <div class="flex justify-between">
      <p>Level</p>
      <p>Talents</p>
    </div>
    <div v-for="level in levels" class="flex justify-between">
      <span class="self-center">{{ level }}</span>
      <TalentsRow :talents="talentsInRow(level)" class=""/>
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