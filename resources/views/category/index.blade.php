
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
                <h3 class="card-title">{{ session('success') }}</h3>
                <!-- /.card-tools -->
              </div>
             
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
                  <h3 class="card-title">La listes des toutes les catégories en taxonomies</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 1%">
                            N°
                        </th>
                        <th style="width: 50%">
                            Catégories
                        </th>
                        <th style="width: 5%">
                            Parent 
                        </th>
                        <th style="width: 20%">
                            Images
                        </th>
                        <th style="width: 20%">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($categories as $category )
                            <tr >
                                
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->parent ? $category->parent->category_name : null }}</td>
                                <td >
                                    <img width="30" height="30" src="{{ Storage::url($category->category_image)  }}" class="img-thumbnail" alt="{{ $category->category_image }}">
                                </td>
                                
                                <td>
                                    <a class="btn btn-info btn-sm edit-btn" href="#" data-toggle="modal" data-target="#edit-{{ $category->id }}" form="edit-{{ $category->id }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm edit-btn" data-toggle="modal" href="#" data-target="#suppr-{{ $category->id }}" form="edit-{{ $category->id }}">
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
                                                                            <select class="form-control" name="parent_id">
                                                                                <option value="">Sélectionnez une catégorie parente</option>
                                                                                @foreach ($categories as $cat)
                                                                                    <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputFile">File input</label>
                                                                            <div class="input-group">
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" id="category_image" name="category_image" onchange="updateFilename(this)">
                                                                                    <label class="custom-file-label" for="category_image">{{ $category->category_image }}</label>
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

                                     {{-- Modal de confirmation de supression --}}
                                    <div class="modal fade" id="suppr-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="supprLabel-{{ $category->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="supprLabel-{{ $category->id }}">Confirmation de suppression</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Êtes-vous sûr de vouloir supprimer cette catégorie ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <form id="edit-{{ $category->id }}" action="{{ route('category.destroy', $category) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                         
                                </td>
                            </tr>
                      @endforeach
                    </tbody>
        
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
    
    </section>
    {{-- Modal pour le formulaire --}}
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
                                        <!-- Text input -->
                                        <div class="form-group">
                                            <label>Nom <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Nom de la catégorie" name="category_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Parent ID <span class="text-red">*</span></label>
                                            <select class="form-control" name="parent_id">
                                                <option value="">Sélectionnez une catégorie parente</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Entrer un fichier</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="category_image" name="category_image" onchange="updateFilename(this)">
                                                    <label class="custom-file-label" for="category_image">Choisir un fichier</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-secondary float-right">Ajouter</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Modal pour le formulaire --}}
   
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function updateFilename(input) {
        if (input.files && input.files[0]) {
        var filename = input.files[0].name;
        $(input).next('.custom-file-label').html(filename);
        }
    }
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