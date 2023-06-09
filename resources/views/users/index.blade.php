@extends('layouts.app')
@section('content')
   <section class="content-header">
     <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Liste des utlisateurs</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Liste des utlisateurs</li>
          </ol>
        </div>
      </div>
     </div><!-- /.container-fluid -->
  </section>
   <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"></h3>
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôles</th>
                        {{-- @can('manage-users') --}}
                        <th>Action</th>
                        {{-- @endcan --}}
                    </tr>
                </thead>
                    <tbody>
                      @foreach ($users as $user)
                      @if (!$user->hasRole('admin'))
                          <tr>
                              <td> {{$user->name }} </td>
                              <td> {{$user->email }} </td>
                              <td> {{ implode(',' , $user->roles()->get()->pluck('name')->toArray()) }} </td>
                              {{-- @can('manage-users') --}}
                              <td>
                                  <a href=" {{route('users.edit', $user->id)}} "><button class=" btn btn-default"><i class="fas fa-pencil-alt"></i></button></a>
                                  
                                  <form action="{{route('users.destroy', $user->id)}}" method="post" class="d-inline">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                  </form>
                                  
                              </td>
                              {{-- @endcan --}}
                          </tr>
                      @endif
                  @endforeach
                    </tbody>
            </table>
        </div>
    </div>
@endsection






