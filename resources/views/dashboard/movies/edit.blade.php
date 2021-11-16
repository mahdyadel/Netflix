@extends('layouts.dashboard.app')
@section('title', '|Edit Movies')

@section( 'content')

    <div>
        <h2>Movies</h2>
    </div>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('dashboard.roles.index') }}">Movies </a></li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <form id="movie__properties"
                action="{{ route('dashboard.movies.update' , ['movie' => $movie->id , 'type' => 'update']) }}"
                 method="post"
                 enctype = "multipart/form-data"
                 >
              @csrf
              @method('put')

              @include('dashboard.partials._errors')

            

              {{--  Name  --}}
                  <div class="form-group">
                      <label>Name</label>
                      <input type = "text" name = "name" id="move__name" value="{{ old('name' , $movie->name) }}" class="form-control">
                  </div>

                   {{--  Description  --}}
                   <div class="form-group">
                      <label>Description</label>
                      <textarea type = "text" name = "description"  class="form-control">{{ old('description' , $movie->description) }}</textarea>
                  </div>

                   {{--  Poster  --}}
                   <div class="form-group">
                      <label>Poster</label>
                      <input type = "file" name = "poster"  class="form-control">
                      <img src="{{ $movie->poster_path }}" style=" margin-top:10px;width:255px;height:378px;" alt="">
                  </div>

                   {{--  Image  --}}
                   <div class="form-group">
                      <label>Image</label>
                      <input type = "file" name = "image"   class="form-control">
                      <img src="{{ $movie->image_path }}" style=" margin-top:10px;width:300px;height:300px;" alt="">
                  </div>

                    {{--categories--}}
                    <div class="form-group">
                        <label>Category</label>
                        <select name="categories[]" class="form-control select2" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ in_array($category->id, $movie->categories->pluck('id')->toArray()) ? 'selected' : ''}}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{--  year  --}}
                    <div class="form-group">
                      <label>Year</label>
                      <input type = "text" name = "year" value="{{ old('year' , $movie->year) }}"  class="form-control">
                  </div>

                   {{--  Rating  --}}
                   <div class="form-group">
                      <label>Rating</label>
                      <input type = "number"  min="1"  name = "rating" value="{{ old('rating' , $movie->rating) }}"  class="form-control">
                  </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit">Edit Movie</i></button>
                    </div>
            
                </form>
            </div>
        </div>
    </div>

@endsection
