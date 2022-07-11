<?php

use App\Category;
use Illuminate\Database\Seeder;
use App\Post;

class UpdatePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // mi prendo tutti i post
        // li ciclo e ad ogni ciclo assegno alla foreign key (category_id), creata nella migration update_posts_table, un id in ordine random della tabella categories

        $posts = Post::all();

        // li ciclo
        foreach ($posts as $post) {

            // ad ogni ciclo assegno alla foreign key (category_id), creata nella migration update_posts_table, un id in ordine random della tabella categories
            $category_id = Category::inRandomOrder()->first()->id;

            // assegno i valori alla colonna category_id della tabella posts
            $post->category_id = $category_id;

            // faccio l'update di $post (non devo passargli category_id perché gliel'ho gia assegnata)
            $post->update();
        }

    }
}
