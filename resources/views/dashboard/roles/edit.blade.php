@extends('layouts.dashboard.app')
@section('title', '|Edit Roles')

@section( 'content')

    <div>
        <h2>Roles</h2>
    </div>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{ route('dashboard.roles.index') }}">Roles </a></li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <form action="{{ route('dashboard.roles.update' , $role->id) }}" method="post">
                    @csrf
                    @method('PUT')
            
                    @include('dashboard.partials._errors')
            
                    {{-- name --}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{old('name' ,  $role->name) }}" class="form-control" required>
                    </div>
                    {{-- permissions --}}
                    <div class="form-group">
                        <h4 style="font-weight: 400">Permissions</h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:15%">Model</th>
                                    <th>Permissions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                   $models = ['categories' , 'movies' ,  'users' , 'settings'];
                                @endphp
                                @foreach ($models as $index=>$model )
                                   <tr>
                                       <td>{{ $index+1 }}</td>
                                       <td class="text-capitalize">{{ $model }}</td>
                                       <td>
                                           @php
                                               $permission_maps = ['create' ,  'read' , 'update', 'delete'];
                                           @endphp
                                            @if($model == 'settings')
                                        
                                        @php
                                        $permission_maps = ['create' ,  'read' ];
                                        @endphp

                                    @endif
                                           
                                           <select name="permissions[]" class="form-control select2" multiple>
               
                                               @foreach ($permission_maps as $permission_map)
                                                   <option 
                                                   value="{{ $permission_map . '_' . $model }}"
                                                   {{ $role->hasPermission($permission_map .'_'. $model) ? 'selected' : ' ' }}
                                                   >
                                                   {{ $permission_map }}</option>
                                               @endforeach
                                           </select>
                                       </td>
               
                                       
                                   </tr>
                                    
                                @endforeach
                            </tbody>
               
                        </table>
                       </div>
               
            
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit">Edit Role</i></button>
                    </div>
            
                </form>
            </div>
        </div>
    </div>

@endsection
