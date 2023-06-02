@extends('layouts.app')
@section('content')
<section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>{{$role->name}}</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="#">Home</a></li>
           <li class="breadcrumb-item active">DataTables</li>
         </ol>
       </div>
     </div>
   </div><!-- /.container-fluid -->
 </section>
<div class="card">
    <div class="card-body">
          <form action="{{route('roles.modify', $role->id)}}" method="POST">
            @csrf
            <input type="hidden" name="role_id" value="{{$role->id}}" id="">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th style="width: 10px">#</th>
                     <th>Entité</th>
                     <th>Create</th>
                     <th>Read</th>
                     <th>Update</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($models as $model)
                  <tr>
                     <td> {{++$i}} </td>
                     <td>
                        {{ $model }}
                     </td>
                     @foreach ($actions as $action)
                     <td class="icheck-primary  ">
                           <input type="checkbox" id=""
                           @php
                           $verify =  DB::select('select * from role_police where role_id = ? and model = ? and action = ? ', [$role->id, $model, $action] );
                           @endphp
                           @if ($verify)
                           @if (auth()->user()->hasRole('admin'))
                           checked
                           @endif
                           @else
                           @endif
                             name="form[{{$model.'_'.$action}}]"  class="justify-center" spellcheck="false">
                     </td>
                     @endforeach
                  </tr>
                  @endforeach
               </tbody>
            </table><br>
            <div class="text-center">
             <button type="submit" class="btn btn-default border float-right"><i class="fas fa-save"></i></button>
          </div>
          </form>
    </div>
 </div>
@endsection