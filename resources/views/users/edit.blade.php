@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">
                        Modifier <strong> {{$user->name}} </strong>
                    </div>
                    <div class="card-body">
                        <form action="{{route('users.update', $user)}}" method="post">
                            @csrf
                            @method('PATCH')
                            @foreach ($roles as $role)
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="roles[]" value=" {{$role->id}} " id="{{$role->id}}"
                                @foreach ($user->roles as $userRole)
                                    @if ($userRole->id ===  $role->id)
                                    checked
                                    @endif
                                @endforeach
                                >
                                <label for="{{$role->id}}" class="form-check-label">  {{$role->name}} </label>
                            </div>
                        @endforeach
                            <button type="submit" class="btn btn-default">Modifier les rôles</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection