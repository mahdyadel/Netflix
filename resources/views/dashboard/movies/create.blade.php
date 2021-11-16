@extends('layouts.dashboard.app')
@section('title', '|Create Movies')

@push('styles')
    <style>
        #movie__upload-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25vh;
            flex-direction: column;
            cursor: pointer;
            border: 1px solid black;
        }
    </style>

@endpush

@section( 'content')

<h2>Movies</h2>
  <ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
    <li class="breadcrumb-item"> <a href="{{ route('dashboard.roles.index') }}">Movies </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
  </ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">
          <div id="movie__upload-wrapper"
                     onclick="document.getElementById('movie__file-input').click()"
                     style="display:{{ $errors->any() ? 'none' :'flex' }};"
                >
                    <i class="fa fa-video-camera fa-2x"></i>
                    <p>Click to upload</p>
                </div>


            <input type="file"
             name=""
             data-url= "{{ route('dashboard.movies.store') }}"
              data-movie-id="{{ $movie->id }}"
               id="movie__file-input"
                 style="display:none;">

            <form id="movie__properties"
                  action="{{ route('dashboard.movies.update' , ['movie' => $movie->id , 'type' => 'publish']) }}"
                   method="post"
                   enctype = "multipart/form-data"
                   style="display:{{ $errors->any() ? 'block' :'none' }};"
                   >
                @csrf
                @method('put')

                @include('dashboard.partials._errors')

                {{--  progers  --}}

                <div calss="form-group" style="display:{{ $errors->any() ? 'none' :'block' }};">
                    <label id="movie__upload-status">Uploading</label>
                    <div class="progress">
                        <div class="progress-bar" id="movie__upload-progerss" role="progressbar"></div>
                    </div>
                </div>

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
                    </div>

                     {{--  Image  --}}
                     <div class="form-group">
                        <label>Image</label>
                        <input type = "file" name = "image"   class="form-control">
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
                    <button type="submit" id = "movie__submit-btn" style="display:none;" class="btn btn-primary"><i class="fa fa-plus">Publish</i></button>
                </div>

            </form>
        </div>
    </div>{{-- end of col-md-12 --}}
</div>{{-- end of row --}}

@endsection
