@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2> Afficher un role</h2>
            </div>
            <div class="text-right mx-4">
                <a class="btn btn-outline-primary" href="{{ route('roles.index') }}"><i class="bi bi-arrow-left-circle">Retour</i> </a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Libellé:</strong>
                {{ $role->name }}
            </div>
        </div>
    </div>
@endsection