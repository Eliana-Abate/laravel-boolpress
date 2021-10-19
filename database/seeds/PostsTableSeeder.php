<?php

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 20; $i++) {
            $post = new Post();
            $post->title = $faker->text(50);
            $post->content = $faker->paragraphs(2, true);
            $post->image = $faker->imageUrl();
            $post->slug = Str::slug($post->title, '-');
            $post->save();
        }
    }
}
