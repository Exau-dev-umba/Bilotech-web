
@extends('layouts.app')

@section('content')
@section('title')
    <a href="#">Articles</a>
@endsection
@section('content')
    <section class="content">
        @if (session('success'))
        <div class="col-md-6">
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
        
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">La listes des tous les articles</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 1%">
                            N°
                        </th>
                        <th style="width: 30%">
                            Articles
                        </th>
                        <th style="width: 30%">
                            Users
                        </th>
                      
                        <th style="width: 10%">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($articles as $article )
                            <tr >
                                
                                <td>{{ ($articles->currentPage() - 1) * $articles->perPage() + $loop->iteration }} </td>
                                <td>{{ $article->title}}</td>
                                <td>{{ $article->user->name }}</td>
                                
                                <td>
                                    
                                    <a class="btn btn-danger btn-sm edit-btn" data-toggle="modal" href="#" data-target="#suppr-{{ $article->id }}" form="edit-{{ $article->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                     
                                     {{-- Modal de confirmation de supression --}}
                                    <div class="modal fade" id="suppr-{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="supprLabel-{{ $article->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="supprLabel-{{ $article->id }}">Confirmation de suppression</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <form id="edit-{{ $article->id }}" action="{{ route('articles.destroy', $article) }}" method="POST">
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