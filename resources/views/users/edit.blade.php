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
                            <div class="input-group mb-3">
                                <label for="name" class="col-md-4 col-form-label">Nom</label>
                                <input type="text" name="name" value="{{ old('email')?? $user->name  }}" placeholder="nom"
                                    class="form-control @error('name') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-user"></span></div>
                                </div>
                                @error('name')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <label for="email" class="col-md-4 col-form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email')?? $user->email }}" placeholder="Email"
                                    class="form-control @error('email') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                </div>
                                @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            @foreach ($roles as $role) 
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="roles[]" value=" {{$role->id}} " id="{{$role->id}}"
                                @if ($user->roles->pluck('id')->contains($role->id)) checked
                                    
                                @endif
                                >
                                <label for="{{$role->id}}" class="form-check-label">  {{$role->name}} </label>
                            </div>
                        @endforeach
                            
                            <div class="float-end">
                                <button type="submit" class="btn btn-outline-primary">Modifier les informations</button>
                             </div>
                            <div class="text-right mx-4">
                                <a class="btn btn-outline-success fas fa-arrow-alt-circle-left " href="{{ route('users.index') }}"> Retour</a>
                             </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection