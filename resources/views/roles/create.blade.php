
<div>
    @extends('layouts.modal')

    @section('id_modal')
        id="create_modal"
    @endsection

    @section('modal-title')
        <h4 class="modal-title">Ajouter d'un nouveau role</h4>
    @endsection
    @section('modal-content')
        <form class="form-horizontal" action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="col-xm-6">
                    <div class="form-group">
                        <label for="name">Role</label>
                        <input type="text" name="name" class="form-control" placeholder="le nom du role" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-default"><i class="fas fa-save"></i></button>
                <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-times-circle"></i></button>
            </div>
        </form>
    @endsection
</div>