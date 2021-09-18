<template>
  <div class="flex flex-col items-center">
    <div class="flex items-center">
      <Talent v-for="talent in sortedTalents" :key="talent.id" :talent="talent" />
    </div>
  </div>
</template>

<script>
    import Talent from './Talent.vue';
    
    export default {
        components: {
            Talent
        },
        props: ['talents'],
        computed: {
          sortedTalents() {
            return this.talents.sort((a, b) => a.position - b.position);
          }
        }
    }
</script>
