<template>
    <div>
        <TalentsList :talents="talentsData" />
        <div class="mt-5 flex justify-center">
            <template v-if="mode === 'show'">
                <Clipboard 
                    :talents="talentsData"
                    :heroName="hero.name"
                />
            </template>
            <template v-else-if="mode === 'create'">
                <div class="flex flex-col">
                    <div>
                        <label for="buildName" class="mr-4">Build name</label>
                        <input type="text" v-model="buildName" id="buildName">
                    </div>
                    <button @click="handleCreateBuild">Create build</button>
                </div>
            </template>
            <template v-else-if="mode === 'edit'">
                <div class="flex flex-col">
                    <div>
                        <label for="buildName" class="mr-4">Build name</label>
                        <input type="text" v-model="buildName" id="buildName">
                    </div>
                    <button @click="handleEditBuild">Edit build</button>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
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
            TalentsList
            
        },
        props: [
            'hero',
            'talents',
            'build',
            'mode'
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
