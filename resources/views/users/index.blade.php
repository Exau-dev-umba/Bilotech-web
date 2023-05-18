@extends('layouts.app')
  @section('content')
   <div class="card">
    @can('manage-users')
        <div class="card-header text-center">
            <h3 class="card-title">Liste des utlisateurs</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôles</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>  # </td>
                        <td> {{$user->name }} </td>
                        <td> {{$user->email }} </td>
                        <td> {{ implode(',' , $user->roles()->get()->pluck('name')->toArray()) }} </td>
                        <td>
                            @can('edit-users')
                            <a href=" {{route('users.edit', $user->id)}} "><button class=" btn btn-default"><i class="fas fa-pencil-alt"></i></button></a>
                            @endcan
                            

                            @can('delete-users')
                            <form action="{{route('users.destroy', $user->id)}}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>  
                            @endcan
                            
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    @endcan
    </div>
@endsection