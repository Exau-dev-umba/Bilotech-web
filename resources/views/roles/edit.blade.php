@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Role</span>
            <input type="text" class="form-control" value="{{$role->name}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
       <table class="table table-bordered">
          <thead>
             <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
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
                <td>
                   <div class="icheck-primary d-inline ">
                      <input type="checkbox" id="checkboxPrimary2" class="justify-center" spellcheck="false">
                   </div>
                </td>
                <td>
                   <div class="icheck-primary d-inline">
                      <input type="checkbox" id="checkboxPrimary2" spellcheck="false">
                   </div>
                </td>
                <td>
                   <div class="icheck-primary d-inline">
                      <input type="checkbox" id="checkboxPrimary2" spellcheck="false">
                   </div>
                </td>
                <td>
                   <div class="icheck-primary d-inline">
                      <input type="checkbox" id="checkboxPrimary2" spellcheck="false">
                   </div>
                </td>
             </tr>
             @endforeach
          </tbody>
       </table><br>
       <div class="float-end">
        <a href="{{route('roles.edit', $role->id)}}" class="btn btn-outline-primary">Editer</a>
     </div>
     <div class="text-right mx-4">
        <a class="btn btn-outline-success fas fa-arrow-alt-circle-left " href="{{ route('roles.index') }}"> Retour</a>
     </div>
    </div>
 </div>
@endsection