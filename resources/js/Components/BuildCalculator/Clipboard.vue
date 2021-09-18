<template>
  <button @click="handleClipboardWrite">Add build to clipboard</button>
</template>

<script>
export default {
  props: ['heroName', 'talents'],
  methods: {
    handleClipboardWrite() {
      let clipBoardText = '[T';
      for (const talent of this.talents) {
        if (!talent.isSelected) {
          continue;
        }
        clipBoardText += talent.position;
      }
      clipBoardText += `,${this.heroName}]`;
      navigator.clipboard.writeText(clipBoardText);
    }
  }
}
</script>