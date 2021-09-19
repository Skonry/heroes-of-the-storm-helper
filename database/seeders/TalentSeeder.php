<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;
use App\Models\Hero;

class TalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filesNames = ['abathur', 'alarak', 'alexstrasza', 'ana', 'anduin', 'anubarak',
        'artanis', 'arthas', 'auriel', 'azmodan', 'blaze', 'brightwing', 'cassia',
        'chen', 'chogall', 'chromie', 'deathwing', 'deckard', 'dehaka', 'diablo',
        'dva', 'etc', 'falstad', 'fenix', 'gall', 'garrosh', 'gazlowe', 'genji',
        'greymane', 'guldan', 'hanzo', 'illidan', 'imperius', 'jaina', 'johanna',
        'junkrat', 'kaelthas', 'kelthuzad', 'kerrigan', 'kharazim', 'leoric',
        'lili', 'liming', 'lostvikings', 'ltmorales', 'lucio', 'lunara', 'maiev',
        'malfurion', 'malganis', 'malthael', 'medivh', 'mephisto', 'muradin', 'murky',
        'nazeebo', 'nova', 'orphea', 'probius', 'qhira', 'ragnaros', 'raynor',
        'rehgar', 'rexxar', 'samuro', 'sgthammer', 'sonya', 'stitches', 'stukov',
        'sylvanas', 'tassadar', 'thebutcher', 'thrall', 'tracer', 'tychus', 'tyrael',
        'tyrande', 'uther', 'valeera', 'valla', 'varian', 'whitemane', 'xul', 'yrel',
        'zagara', 'zarya', 'zeratul', 'zuljin'];

        foreach($filesNames as $fileName)
        {
            $data = $this->loadJsonData($fileName);
            $hero = Hero::where('name', '=', $data->name)->first();
            $talentLevels = ['1', '4', '7', '10', '13', '16', '20'];
            
            foreach($talentLevels as $level)
            {
                foreach($data->talents->{$level} as $talent)
                {
                    DB::table('talents')->insert([
                        'hero_id' => $hero->id,
                        'level' => $level,
                        'name' => $talent->name,
                        'icon' => $talent->icon,
                        'description' => $talent->description,
                        'position' => $talent->sort
                    ]);
                }
            }
        }
    }
    private function loadJsonData($fileName)
    {
        $json = Storage::disk('public')->get('heroes_data/' . $fileName . '.json');
        $data = json_decode($json);
        return $data;
    }
}
