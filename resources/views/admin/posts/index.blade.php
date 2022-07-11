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
                <th scope="col">description</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post )
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        <td>{{$post->category ? $post->category->name : '/'}}</td>
                        <td>{{$post->description}}</td>
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
    <div class="bg-info p-2 mb-5">
        <h2 class="title-content">Posts divisi per categorie</h2>


        <div class="accordion" id="accordionExample">

            @foreach ($categories as $category)

                <div class="accordion">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {{$category->name}}
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul class="list-group">

                            @forelse ($category->posts as $post)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto fw-bold">
                                        {{$post->title}}
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
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto fw-bold">
                                        Nessun post appartenente a questa categoria
                                    </div>
                                </li>
                            @endforelse

                        </ul>
                    </div>
                </div>
                </div>
            @endforeach

        </div>

    </div>
    {{-- /Post divisi per categorie --}}

</div>

@endsection
