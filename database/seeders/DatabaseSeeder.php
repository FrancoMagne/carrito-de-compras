<?php

namespace Database\Seeders;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('usuarios');
        Storage::makeDirectory('usuarios');

        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        Categoria::factory(5)->create();
        Articulo::factory(40)->create();
        $this->call(ProvinceSeeder::class);
    }
}
