<template>
  <div>
    <div v-show="tooltipVisible" class="absolute z-50 bg-black text-white top-0 left-0 w-">
      <b>{{this.talent.name}}</b>
      <p>{{this.talent.description}}</p>
    </div>
    <img 
      :src="'/images/talents/' + talent.icon"
      :class="{'filter grayscale': !talent.isSelected}"
      @mouseover="tooltipVisible = true"
      @mouseleave="tooltipVisible = false"
      @click="onClickTalent"
    >
  </div>  
</template>

<script>
    export default {
      inject: ['handleClickTalent', 'mode'],
      data() {
        return {
          tooltipVisible: false
        }
      },
      props: ['talent'],
      methods: {
        onClickTalent() {
          if (this.mode === 'show') {
            return;
          }
          this.handleClickTalent(this.talent.id, this.talent.level);
        }
      }
    }
</script>

<style scoped>
.gray-image {
  filter: grayscale(1);
}
</style>
