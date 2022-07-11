@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">

                <h1>Creo il post</h1>

                <form action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" id="title" name="title" placeholder="Titolo"
                        value="{{ old('title') }}"
                        class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        {{-- <p class="invalid-feedback" id="error-title"></p> --}}
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Url immagine</label>
                        <input type="text" id="image" name="image" placeholder="URL immagine"
                        value="{{ old('image') }}"
                        class="form-control @error('image') is-invalid @enderror" required>
                        @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        {{-- <p class="invalid-feedback" id="error-image"></p> --}}
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label> <br>
                        <textarea name="description" id="description" cols="30" rows="10"
                        class="form-control @error('title') is-invalid @enderror" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        {{-- <p class="invalid-feedback" id="error-description"></p> --}}
                    </div>

                    <div class="mb-3">
                        <select class="form-select" name="category id">
                            <option value="">Seleziona una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if($category->id == old('category_id')) selected @endif>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                        {{-- <p class="invalid-feedback" id="error-category-id"></p> --}}
                    </div>

                    <div class="mb-3">
                        @foreach ($tags as $tag)
                        <input type="checkbox"
                        name="tags[]"
                        id="tag{{$loop->iteration}}"
                        value="{{ $tag->id }}"
                        @if (in_array($tag->id, old('tags', [])))
                            checked
                        @endif>
                        <label class="mr-3" for="tag{{$loop->iteration}}">{{$tag->name}}</label>
                        @endforeach
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>

@endsection
