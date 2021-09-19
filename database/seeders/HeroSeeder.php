<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
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
        'greymane', 'guldan', 'hanzo', 'hogger', 'illidan', 'imperius', 'jaina', 'johanna',
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
            DB::table('heroes')->insert([
                'name' => $data->name,
                'icon' => $data->icon
            ]);
        }
    }
    private function loadJsonData($fileName)
    {
        $json = Storage::disk('public')->get('hero/' . $fileName . '.json');
        $data = json_decode($json);
        return $data;
    }
}
