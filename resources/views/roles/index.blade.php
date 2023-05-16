@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Roles </h2>
            </div>
            <div class="text-right mx-4">
                <a class="btn btn-outline-success" href="{{ route('roles.create') }}"><i class="fas fa-plus-circle"></i></a><br>
            </div>
        </div>
    </div><br>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Libellé</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $role)
        <tr>
           
            <td>{{ $role->name }}</td>
            <td>
                <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
   
                    <a class="btn btn-outline-primary" href="{{ route('roles.show',$role->id) }}"><i class="fas fa-folder"></a>
    
                    <a class="btn btn-outline-success" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-pencil-alt"></a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center pagination-lg">
    {!! $roles->links('pagination::bootstrap-4') !!}
      </div>
@endsection             