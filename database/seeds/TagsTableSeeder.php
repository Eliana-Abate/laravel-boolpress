<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tag_names = ['Mediterranean', 'Italy', 'Europe', 'Local', 'Greece', 'Spain'];
        foreach ($tag_names as $name) {
            $tag = new Tag();
            $tag->name = $name;
            $tag->color = $faker->hexColor();
            $tag->save();
        }
    }
}
