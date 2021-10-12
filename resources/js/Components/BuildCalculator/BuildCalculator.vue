<template>
  <div class="flex flex-col mx-auto w-[500px]">
    <div>
      <TalentsList :talents="talentsData" />
    </div>
    <div>
      <template v-if="mode === 'show'">
        <div class="mt-8">
          <Clipboard 
            :talents="talentsData"
            :heroName="hero.name"
          />
        </div>
        <div class="mt-8">
          <Link 
            v-if="userIsOwner" 
            :href="route('heroes.builds.edit', [hero.id, build.id])" 
            class="mr-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
          >
            Edit build
          </Link>
          <button
            v-if="userIsOwner" 
            @click="handleDeleteBuild"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
          >
            Delete build
          </button>
        </div>
      </template>
      <template v-else-if="mode === 'create'">
        <div>
          <div class="mt-8">
            <label for="buildName" class="mr-4">Build name</label>
            <input type="text" v-model="buildName" id="buildName">
          </div>
          <button 
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mt-8" 
            @click="handleCreateBuild"
          >
            Create build
          </button>
        </div>
      </template>
      <template v-else-if="mode === 'edit'">
        <div class="mt-8">
          <label for="buildName" class="mr-4">Build name</label>
          <input type="text" v-model="buildName" id="buildName">
        </div>
        <div class="mt-8">
          <button 
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" 
            @click="handleEditBuild"
          >
            Edit build
          </button>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import Clipboard from './Clipboard';
import TalentsList from './TalentsList';

export default {
  data() {
    return {
      buildName: this.build?.name,
      talentsData: [...this.talents]
    };
  },
  provide() {
    return {
      handleClickTalent: this.handleClickTalent,
      mode: this.mode
    };
  },
  components: {
    Clipboard,
    TalentsList,
    Link
  },
  props: [
    'hero',
    'talents',
    'build',
    'mode',
    'userIsOwner'
  ],
  methods: {
    handleCreateBuild() {
      this.$inertia.post(`/heroes/${this.hero.id}/builds`, {
        buildName: this.buildName,
        talentsIds: this.getSelectedTalentsIds()
      });
    },
    handleEditBuild() {
      this.$inertia.patch(`/heroes/${this.hero.id}/builds/${this.build.id}`, {
        buildName: this.buildName,
        talentsIds: this.getSelectedTalentsIds()
      });
    },
    handleDeleteBuild() {
      this.$inertia.delete(`/heroes/${this.hero.id}/builds/${this.build.id}`);
    },
    handleClickTalent(id, level) {
      this.talentsData = this.talentsData.map(talent => {
        if (talent.isSelected && talent.level === level) {
          return {
              ...talent,
              isSelected: false
          }
        }
        if (talent.id === id) {
          return {
              ...talent,
              isSelected: !talent.isSelected
          }
        }
        return talent;
      });
    },
    getSelectedTalentsIds() {
      return this.talentsData
        .filter(talent => talent.isSelected)
        .map(talent => talent.id);
    }
  }
}
</script>
