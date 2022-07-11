<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ciclo for per popolare la tabella ponte (collego i tag ai post randomicamente)

        for ($i=0; $i < 20; $i++) {

            // prendo un post random
            $random_post = Post::inRandomOrder()->first();

            // prendo un tag random
            $random_tag_id = Tag::inRandomOrder()->first()->id;

            // prendo il post che ho creato, gli concateno il metodo tags() creato nel model e al metodo attach gli passo l'id del tag random
            $random_post->tags()->attach($random_tag_id);
        }
    }
}
