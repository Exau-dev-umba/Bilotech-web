@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Utilisateur <strong> {{$user->name}} </strong></h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="#">Home</a></li>
           <li class="breadcrumb-item active">Attribution des rôles</li>
         </ol>
       </div>
     </div>
    </div><!-- /.container-fluid -->
 </section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('users.update', $user)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="input-group mb-3">
                                <label for="name" class="col-md-4 col-form-label">Nom : {{$user->name}}</label>
                            </div>
                            <div class="input-group mb-3">
                                <label for="email" class="col-md-4 col-form-label">Email : {{$user->email}}</label>
                            </div>
                        <div class="row">
                            <div class="col-12">
                              <!-- Custom Tabs -->
                              <div class="card">
                                <div class="card-header d-flex p-0">
                                  <h3 class="card-title p-3"></h3>
                                  <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Securité</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Agent</a></li>
                                  </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                  <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        @foreach ($roles as $role)
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" name="roles[]" value=" {{$role->id}} " id="{{$role->id}}"
                                            @if ($user->roles->pluck('id')->contains($role->id)) checked
                                            @endif
                                            >
                                            <label for="{{$role->id}}" class="form-check-label">  {{$role->name}} </label>
                                        </div>
                                    @endforeach
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <a href="#"><strong> {{$user->name}} </strong></a>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <!-- /.tab-pane -->
                                  </div>
                                  <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                              </div>
                              <!-- ./card -->
                            </div>
                            <!-- /.col -->
                          </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-outline-default border"><i class="fas fa-save"></i></button>
                             </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection











