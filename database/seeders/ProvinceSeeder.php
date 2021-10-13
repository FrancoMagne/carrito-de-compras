<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Departament;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::factory(8)->create()->each(function(Province $province) {
            Departament::factory(8)->create([
                'province_id' => $province->id
            ]);
        });
    }
}
