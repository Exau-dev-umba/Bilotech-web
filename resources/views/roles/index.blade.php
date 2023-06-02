@extends('layouts.app')
@section('title')
Roles
@endsection
@section('content')
<div class="container">
    <div class="text-right mb-2">
        <a class="btn btn-outline-default border" href="{{ route('roles.create') }}"><i class="fas fa-plus-circle"></i></a><br>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped projects text-center" >
                <thead>
                    <tr>
                        <th class="text-center col-lg-1">
                            Id
                        </th>
                        <th class="text-center col-lg-9">
                            Roles
                        </th>
                        <th class="text-right col-lg-2">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center col-lg-1">
                        @foreach ($roles as $role)
                    <tr>
                      @if ($role->name !== 'admin')

                          <td class="text-center">{{ $role->id }}</td>
                          <td class="text-center col-lg-9">{{ $role->name }}</td>

                 
                        <td class="text-right  col-lg-2">
                            <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                                <a class="btn btn-outline-primary fas fa-folder" href="{{ route('roles.show',$role->id) }}"></a>
                                @permission('delete', 'User')
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                @endpermission
                            </form>
                        </td>
                         @endif
                    </tr>
                    @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="d-flex justify-content-center pagination-lg">
        {!! $roles->links('pagination::bootstrap-4') !!}
    </div>
</div>
@endsection







