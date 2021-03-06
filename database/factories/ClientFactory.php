<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=$this->faker->name();
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'phone'=>$this->faker->numerify('809-###-####'),
            'rnc'=>$this->faker->numerify('###########'),
            'debt'=>0,
        ];
    }
}
