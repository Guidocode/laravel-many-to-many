@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">

                <h1>Modifico il post: {{ $post->title }}</h1>

                <form action="{{ route('admin.posts.update', $post, $post->category ? $post->category->id : '') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" id="title" name="title" placeholder="Titolo"
                        value="{{ old('title', $post->title) }}"
                        class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Url immagine</label>
                        <input type="text" id="image" name="image" placeholder="URL immagine"
                        value="{{ old('image', $post->image) }}"
                        class="form-control @error('image') is-invalid @enderror" required>
                        @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label> <br>
                        <textarea name="description" id="description" cols="30" rows="10"
                        class="form-control @error('title') is-invalid @enderror" required>{{ old('description', $post->description) }}</textarea>
                        @error('description')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <select class="form-select" name="category id">
                            <option value="">Seleziona una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if($category->id == old('category_id', $post->category ? $post->category->id : '')) selected @endif>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        @foreach ($tags as $tag)
                        <input type="checkbox"

                        @if (!$errors->any() && $post->tags->contains($tag->id))
                            checked
                        @elseif ($errors->any() && in_array($tag->id, old('tags', [])))
                            checked
                        @endif

                        name="tags[]"
                        id="{{$loop->iteration}}"
                        value="{{$tag->id}}">
                        <label class="mr-3" for="{{$loop->iteration}}">{{$tag->name}}</label>
                        @endforeach
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

@endsection
