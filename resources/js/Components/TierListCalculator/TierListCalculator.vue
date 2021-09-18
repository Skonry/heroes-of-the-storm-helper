<template>
  <div class="flex">
    <div>
      <label for="tier-list-name">Tier List Name</label>
      <input type="text" name="tier-list-name" v-model="tierListName" class="form-control">
    </div>
    <button @click="handleCreateTierList" v-if="mode === 'create'">
      Create tier list
    </button>
    <button @click="handleEditTierList" v-else>
      Edit tier list
    </button>
  </div>
  <p>Heroes</p>
  <div>
    <draggable :list="unassignedHeroes" group="heroes" class="grid grid-cols-auto-fill-100px justify-center gap-4" item-key="name">
      <template #item="{ element }">
        <img :src="'/images/heroes/' + element.icon" class="w-[100px] h-[100px]">
      </template>
    </draggable>
  </div>
  <div>
    <button @click="handleAddTier" class="mr-4">
      Add tier
    </button>
    <button @click="handleRemoveTier">
      Remove tier
    </button>
  </div>
  <p>Tiers</p>
  <div v-for="tier in tiers" :key="tier.name">
    <div>
      {{ tier.name }}
    </div>
    <draggable :list="tier.heroes" group="heroes" :style="{minHeight: '102px'}" class="flex flex-wrap border border-black" item-key="name">
      <template #item="{ element }">
        <img :src="'/images/heroes/' + element.icon" class="w-[100px] h-[100px]">
      </template>
    </draggable>
  </div>
</template>

<script>
  import draggable from 'vuedraggable';

  export default {
    props: ['heroes', 'mode', 'tierList'],
    components: {
      draggable
    },
    data() {
      const tiers = this.mode === 'edit' ? this.tierList.tiers : [{ name: 'S', heroes: []}];
      const unassignedHeroes = this.mode === 'edit' ? this.calculateUnassignedHeroes(tiers) : this.heroes;
      return {
        tierListName: this.tierList?.name ? this.tierList.name : '',
        tiers, 
        unassignedHeroes,
        tierNames: ['S', 'A', 'B', 'C', 'D', 'F', 'G', 'H', 'I'],
      }
    },
    methods: {
      handleAddTier() {
        const MAX_NUMBER_OF_TIERS = 10;

        if (this.tiers.length === MAX_NUMBER_OF_TIERS) {
          return;
        }
        this.tiers.push({
          heroes: [],
          name: this.tierNames[this.tiers.length]
        });
      },
      handleRemoveTier() {
        if (this.activeTiers === 1) {
          return;
        }
        this.unassignedHeroes = this.unassignedHeroes.concat(this.tiers[this.tiers.length - 1].heroes);
        this.tiers.pop();
      },
      handleCreateTierList() {
        const tiers = [];
        for(let i = 0; i < this.tiers.length; i++) {
          const heroes_ids = this.tiers[i].heroes.map(hero => hero.id);
          tiers.push({ name: this.tiers[i].name, heroes_ids });
        }
        this.$inertia.post('/tier_lists', {
          tier_list_name: this.tierListName,
          tiers
        });
      },
      handleEditTierList() {
        const tiers = [];
        for(let i = 0; i < this.tiers.length; i++) {
          const heroes_ids = this.tiers[i].heroes.map(hero => hero.id);
          tiers.push({ name: this.tiers[i].name, heroes_ids });
        }
        this.$inertia.put(`/tier_lists/${this.tierList.id}`, {
          name: this.tierListName,
          tiers
        });
      },
      calculateUnassignedHeroes(tiers) {
        let unassignedHeroes = [...this.heroes];
        tiers.forEach(tier => {
          tier.heroes.forEach(hero => {
            unassignedHeroes = unassignedHeroes.filter(unassignedHero => 
              unassignedHero.name !== hero.name
            );
          });
        });
        return unassignedHeroes;
      }
    }
  }
</script>