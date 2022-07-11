<?php

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // use App\Post;
        // use Faker\Generator as Faker;
        // popolo la tabella con dati fake con ciclo for

        for ($i=0; $i < 20; $i++) {

            $new_post = new Post();

            $new_post->title = $faker->sentence();
            $new_post->slug = Post::genereteSlug($new_post->title);
            $new_post->image = $faker->imageUrl(360, 360, 'animals', true, 'dogs', true, 'jpg');
            $new_post->description = $faker->paragraph();
            $new_post->save();
            // dump($new_post);
        }

    }
}
