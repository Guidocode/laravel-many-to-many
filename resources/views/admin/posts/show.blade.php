@extends('layouts.admin')

@section('content')

    <div class="container">

        <div class="card" style="width: 25rem;">

            <img class="img-fluid" src="{{ $post->image }}" alt="{{ $post->title }}">

            <div class="card-body">

                <h2 class="card-title">{{ $post->title }}</h2>

                @if($post->category)
                        <h4 class="d-inline"><span class="badge bg-info text-dark">{{ $post->category->name }}</span></h4>
                @endif

                @foreach ($post->tags as $tag)
                @if ($post->tags)
                    <h6 class="d-inline ml-2"><span class="badge badge-pill badge-success">{{$tag->name}}</span></h6>
                @endif
                @endforeach

                <p class="card-text">{{ $post->description }}</p>

                <a class="btn btn-secondary mx-1" href="{{ route('admin.posts.index', $post) }}">GO BACK</a>
                <a class="btn btn-primary mx-1" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
                <form class="d-inline mx-1"
                    onsubmit="return confirm('confermi l\'eliminazione di: {{ $post->title }}?')"
                    action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" >DELETE</button>
                </form>
            </div>
        </div>

    </div>

@endsection
