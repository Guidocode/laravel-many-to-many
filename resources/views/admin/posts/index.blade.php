@extends('layouts.admin')

@section('content')

<div class="container">


    {{-- Posts --}}
    <div class="bg-info p-2 mb-5">
        <h2 class="title-content">Posts</h2>

        <table class="table bg-light py-3">
            <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">title</th>
                <th scope="col">slug</th>
                <th scope="col">category</th>
                <th scope="col">tag</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post )
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        <td>
                            <h4><span class="badge bg-info text-dark">{{$post->category ? $post->category->name : '/'}}</span></h4>
                        </td>
                        <td>
                            @forelse ($post->tags as $tag)
                            <h6><span class="badge badge-pill badge-warning">{{$tag->name}}</span></h6>
                            @empty
                            <h6><span class="badge badge-pill badge-warning">/</span></h6>
                            @endforelse
                        </td>
                        <td class="d-flex">
                            <a class="btn btn-success mx-1" href="{{ route('admin.posts.show', $post) }}">SHOW</a>
                            <a class="btn btn-primary mx-1" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
                            <form class="d-inline mx-1"
                                onsubmit="return confirm('confermi l\'eliminazione di: {{ $post->title }}?')"
                                action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" >DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $posts->links() }}
    </div>
    {{-- /Posts --}}



    {{-- Post divisi per categorie --}}
    <div class=" bg-success p-2 mb-5">
        <h2 class="title-content">Posts divisi per categorie</h2>

        <nav id="navbar-example2" class="navbar navbar-light bg-light d-flex justify-content-center">
            <ul class="nav nav-pills">

                @foreach ($categories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="#category{{$loop->iteration}}">{{$category->name}}</a>
                </li>
                @endforeach

            </ul>
        </nav>

        <div data-spy="scroll" data-target="#navbar-example2" data-offset="0" class="position-relative" style="height: 400px; overflow-y: scroll;">
            <ul class="list-group">

                @foreach ($categories as $category)
                    <h3 class="bg-light mt-3 mb-0" id="category{{$loop->iteration}}"><span class="badge bg-info text-dark m-2">{{$category->name}}</span></h3>

                    @forelse ($category->posts as $post)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>

                                <h4>{{$post->title}}</h4>
                            </div>
                            <div class="d-flex">
                                <a class="btn btn-success mx-1" href="{{ route('admin.posts.show', $post) }}">SHOW</a>
                                <a class="btn btn-primary mx-1" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
                                <form class="d-inline mx-1"
                                    onsubmit="return confirm('confermi l\'eliminazione di: {{ $post->title }}?')"
                                    action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" >DELETE</button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Nessun post appartenente a questa categoria
                        </li>
                    @endforelse
                @endforeach

            </ul>
        </div>
    </div>
    {{-- /Post divisi per categorie --}}

@endsection
