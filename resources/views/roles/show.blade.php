@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <strong>Nom du Role : {{$role->name}} </strong>
            </div>
            
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="input-group mb-3">
              </div>
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
                         <td class="">

                        @php
                        $verify =  DB::select('select * from role_police where role_id = ? and model = ? and action = ? ', [$role->id, $model, $action] );

                        
 
                        @endphp
                        @if ($verify)
                        <i class="fas fa-check"></i>
                        @else
                        <i class="fas fa-circle gray"></i>
                        
                        @endif       

                         </td>
                         @endforeach
                       
         
                      </tr>
                      @endforeach
                   </tbody>
                </table><br>
                
                <div class="text-right mx-4">
                    <a class="btn btn-outline-default" href="{{ route('roles.edit', $role->id) }}"><i class="fas fa-pencil-alt"></i></a>
                 </div>
        </div>
     </div>
@endsection