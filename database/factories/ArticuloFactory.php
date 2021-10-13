<?php

namespace Database\Factories;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Categoria;
use App\Models\User;

class ArticuloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Articulo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $name = $this->faker->unique()->word(10);
        $user = User::find(2);
        $url_image = 'public/usuarios/'.$user->email;
        $url_storage = 'public/storage/usuarios/'.$user->email;

        if (!Storage::exists($url_image)) {
            Storage::makeDirectory($url_image);
        }

        return [
            'user_id' => $user->id,
            'category_id' => Categoria::all()->random()->id,
            'name' => $name,
            'quantity' => $this->faker->randomElement([5,10,20]),
            'image' => 'storage/usuarios/'.$user->email.'/'.$this->faker->image($url_storage, 640, 480, null, false), 
            'price' => $this->faker->randomFloat(2, 20, 100),
            'visible' => 1,
            'slug' => Str::slug($name)
        ];
    }
}
