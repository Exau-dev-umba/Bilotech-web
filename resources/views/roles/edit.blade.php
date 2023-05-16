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
       </table>
       <div class="input-group my-3 w-25">
        <a href="{{route('roles.edit', $role->id)}}" class="btn btn-default form-control">Editer</a>
     </div>
    </div>
 </div>
@endsection