@extends('layouts.dashboard.app')
@section('title', '|Movies')
@section('content')

<h2>Movies</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Movies</a></li>
  </ol>
</nav>
<div class="tile mb-4">
    <div class="row">
        <div class="col-12">
            <form action="">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="search" autofocus  class="form-control" placeholder="search" value="{{ request()->search }}">
                        </div>
                    </div>{{--  //end of col  --}}

                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="category" class="form-control">
                                <option>All Categories</option>
                                @foreach($categories as $category)

                                <option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' :' ' }}>{{ $category->name }}</option>
                                    
                                @endforeach
                            </select>
                        </div>
                    </div>{{--  //end of col  --}}

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search">Search</i></button>
                        @if(auth()->user()->hasPermission('create_movies'))
                            <a href="{{ route('dashboard.movies.create') }}" class="btn btn-primary"><i class="fa fa-plus">Add</i></a>
                        @else
                            <a href="#" disabled class="btn btn-primary"><i class="fa fa-plus">Add</i></a>
                        @endif
                    </div>

                </div>{{--  //end of row  --}}
            </form>{{--  //end of form  --}}
        </div>{{--  //end of col-12  --}}
    </div>{{--  //end of row  --}}

    <div class="row">
        <div class="col-md-12">
            @if($movies->count() > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Caegories</th>
                        <th>Year</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movies as $index=> $movie)

                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $movie->name }}</td>
                            <td>{{ Str::limit($movie->description  , 50 )}}</td>
                            <td>
                                @foreach($movie->categories as $category)
                                    <h5 style="display:inline-block;"><span class="badge badge-primary">{{ $category->name }}</span></h5>
                                @endforeach
                            </td>
                            <td>{{ $movie->year }}</td>
                            <td>{{ $movie->rating }}</td>
                          
                            <td>
                                @if(auth()->user()->hasPermission('update_movies'))
                                    <a href="{{ route('dashboard.movies.edit' , $movie->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit">Edit</i></a>
                                @else
                                    <a href="#" disabled class="btn btn-warning btn-sm"><i class="fa fa-edit">Edit</i></a>
                                @endif
                               @if(auth()->user()->hasPermission('delete_movies'))
                               <form action="{{ route('dashboard.movies.destroy' , $movie->id) }}" method="post" style="display: inline-block">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btbn-sm delete"><i class="fa fa-trash">Delete</i></button>
                            </form>
                            @else
                            <a href="#" disabled class="btn btn-danger btn-sm"><i class="fa fa-trash">Delete</i></a>
                            @endif

                            </td>
                        </tr>

                    @endforeach
                </tbody>

            </table>
            {{$movies->appends(request()->query())->links()}}
            @else
            <h3 style="font-weight: 400">Sorry No Data Found </h3>
            @endif
        </div>
    </div>

</div>{{--  //end of tile  --}}

@endsection
