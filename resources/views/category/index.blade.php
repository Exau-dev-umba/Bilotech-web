
@extends('layouts.app')

@section('content')
@section('title')
    <a href="#">Categories</a>
@endsection
@section('content')
    <section class="content">
        @if (session('success'))
        <div class="col-md-3">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">
                    {{ session('success') }}
                </h3>
              </div>
             
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        @endif
        @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                </div>
            @endforeach
        @endif
        <div class="text-right mb-2">
            <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal-default">
                <i class="nav-icon fa fa-plus "></i>
            </button>
        </div>
        <section class="content">   
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            N°
                        </th>
                        <th style="width: 30%">
                            Catégories
                        </th>
                        <th style="width: 15%">
                            Parent 
                        </th>
                        <th style="width: 30%">
                            Images
                        </th>
                        <th style="width: 5%">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category )
                            <tr>
                                
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->parent ? $category->parent->category_name : null }}</td>
                                <td>
                                    <img width="30" height="30" src="{{ asset('storage/' . $category->category_image) }}" class="img-thumbnail" alt="{{ $category->category_image }}">
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm edit-btn" href="#" data-toggle="modal" data-target="#edit-{{ $category->id }}" form="edit-trtr">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a> 
                                    <a class="btn btn-danger btn-sm edit-btn" href="#" data-toggle="modal" data-target="#edit-{{ $category->id }}" form="edit-trtr">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>

                                    {{-- Formulaire Edit --}}
                                    <div class="modal fade edit-form" id="edit-{{ $category->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card card-light">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Modification de la catégorie</h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <form method="POST" action="{{ route('category.update', $category) }}" enctype="multipart/form-data">
                                                                @csrf
                                                                @method("PUT")
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <!-- text input -->
                                                                        <div class="form-group">
                                                                            <label>Nom <span class="text-red">*</span></label>
                                                                            <input type="text" class="form-control" placeholder="Nom de la catégorie" name="category_name" value="{{ $category->category_name }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Parent ID <span class="text-red">*</span></label>
                                                                            <input type="number" class="form-control"  name="parent_id" value="{{ $category->parent_id }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputFile">File input</label>
                                                                            <div class="input-group">
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="category_image">
                                                                                    <label class="custom-file-label" for="exampleInputFile" id="fileLabel">Choisir un fichier</label>
                                                                                </div>
                                                                              <div class="input-group-append">
                                                                                <span class="input-group-text" id="">Upload</span>
                                                                              </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-secondary float-right ">Modifier</button>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Formulaire End Formualire Edit --}}
                                         
                                </td>
                            </tr>
                        @endforeach
                  
                    </tbody>
                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
         
            
         </div>
        </section>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title">Créer une Catégorie</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Nom <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Nom de la catégorie" name="category_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Parent ID <span class="text-red">*</span></label>
                                            <input type="number" min="0" max="10" class="form-control"  name="parent_id" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Entrer un fichier<span class="text-red"> *</span></label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="category_image">
                                                <label class="custom-file-label" for="exampleInputFile">Choisir l'image</label>
                                            </div>
                                              
                                         
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-secondary float-right ">Ajouter</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
            <script>
                document.getElementById('exampleInputFile').addEventListener('change', function(e) {
                var fileName = e.target.files[0].name;
                document.querySelector('.custom-file-label').textContent = fileName;
                });
            </script>
        
            <script  src="{{Vite::asset('node_modules/admin-lte/plugins/jquery/jquery.min.js')}}"></script>
            @vite('node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')
            @vite('node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')
            @vite('node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')
            <script src="{{Vite::asset('node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{Vite::asset('node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
            <script src="{{ Vite::asset('resources/js/scripts.js') }}"></script>
            <script src="{{Vite::asset('node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
            <script src="{{vite::asset('node_modules/admin-lte/dist/js/demo.js')}}"></script>
            <script>
                $(function () {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": true, "autoWidth": true, "searching": true,"ordering": true,"paging": true,
                    "data":""
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                });
            </script>
@endsection
