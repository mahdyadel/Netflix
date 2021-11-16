@extends('layouts.dashboard.app')
@section('title', '|Create Categories')

@section( 'content')

<h2>Categories</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
    <li class="breadcrumb-item"> <a href="{{ route('dashboard.categories.index') }}">Categories </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
  </ol>
</nav>
<div class="tile mb-4">
    <form action="{{ route('dashboard.categories.update' , $category->id) }}" method="post">
        @csrf
        @method('PUT')

        @include('dashboard.partials._errors')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{old('name' ,  $category->name) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-edit">Edit Caegory</i></button>
        </div>

    </form>
</div>

@endsection
