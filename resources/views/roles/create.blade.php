@extends('layouts.app')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-start">
            <h2>Ajouter un nouveau role</h2>
        </div>
    </div>      
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oups! </strong> Il y a eu des problèmes avec votre entrée.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('roles.store') }}" method="POST">
    @csrf
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Libellé:</strong>
                <input type="text" name="name" class="form-control" placeholder="Saisir un libellé">
            </div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-default"><i class="fas fa-save"></i></button>
        </div>
    </div>
   
</form>
@endsection