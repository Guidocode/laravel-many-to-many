<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mi vado a prendere i dati che voglio dal db e li passo alla view index
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        //prendo tutte le categorie e le passo alla show
        $categories = Category::all();

        // dd($posts);

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //prendo tutte le categorie e le passo alla show
        $categories = Category::all();

        // ritorno alla view create
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // arrivano i dati da create

        $data = $request->all();
        $new_post = new Post();

        $data['slug'] = Post::genereteSlug($data['title']);
        $new_post->fill($data);

        $new_post->save();
        // dd($new_post);

        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // vado a prendere il singolo record tramite id e lo passo alla view show
        $post = Post::find($id);

        //prendo tutte le categorie e le passo alla show
        $categories = Category::all();

        return view('admin.posts.show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // modifico il record passato con id
        $post = Post::find($id);

        //prendo tutte le categorie e le passo alla show
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        // salvo la modifica
        $post = Post::find($id);

        $data = $request->all();

        $data['slug'] = Post::genereteSlug($data['title']);
        $post->update($data);

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // cancello l'elemento selezionato

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
