@extends('layouts.app')
@section('title','| MATERIELS')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <style>
        .hide{
            display: none;
        }
    </style>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Materiels</h4>
                    {{--                    <p class="mb-0">Your business dashboard template</p>--}}
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Materiels</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Index</a></li>
                </ol>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <span class="float-left h4">Liste des Materiels</span>
                        <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal"
                                data-target="#personnelModal"><i class="fa fa-plus">&nbsp; Ajouter</i></button>

                        <div class="table-responsive">
                            <table id="example" class="display text-center w-100">
                                <thead class="bg-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Crée le</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->libelle }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->date_ajout }}</td>
                                        {{--                                            <td>{{ $item->date_ajout }}</td>--}}
                                        <td class="d-flex">
{{--                                            <button class="btn btn-sm btn-success" title="Voir les details"><i class="fa fa-eye"></i></button>--}}
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#personnelModal{{ $item->equipement_id }}" title="Editer"><i class="fa fa-edit"></i></button>
                                            <form action="{{ route('equipement.destroy',$item->equipement_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-danger ml-1" title="Supprimer"><i class="fa fa-trash"></i></button>
                                            </form>
                                            <!-- Modal ajouter une personnel -->
                                            <div class="modal fade" data-backdrop="static" id="personnelModal{{ $item->equipement_id }}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Modifier un personnel</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('equipement.store') }}" method="post" id="charge-form{{$item->equipement_id}}">
                                                                @csrf
                                                                <input type="hidden" name="equipement_id" value="{{ $item->equipement_id }}">
                                                                <div class="form-group">
                                                                    <label for="code{{ $item->equipement_id }}">Code <span class="text-danger">*</span></label>
                                                                    <input type="text" name="code" id="code{{ $item->equipement_id }}" value="{{ $item->code }}" placeholder="Code" required class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="libelle{{ $item->equipement_id }}">Nom <span class="text-danger">*</span></label>
                                                                    <input type="text" name="libelle" id="libelle{{ $item->equipement_id }}" placeholder="Nom" value="{{ $item->libelle }}" required class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="description{{ $item->equipement_id }}">Description</label>
                                                                    <textarea name="description" id="description{{ $item->equipement_id }}" class="form-control" placeholder="Description">{{ $item->description }}</textarea>
                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                                </div>
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
                        {!! $data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ajouter une personnel -->
    <div class="modal fade" data-backdrop="static" id="personnelModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un équipement</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('equipement.store') }}" method="post" id="charge-form">
                        @csrf
                        <div class="form-group">
                            <label for="code">Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" id="code" placeholder="Code" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="libelle">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="libelle" id="libelle" placeholder="Nom" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
{{--    @include('gestion.charge_modal')--}}
@endsection
@section('script')
    <script>
        function deleteFun(id) {
            var table = $('#example').DataTable();
            swal.fire({
                title: "Supprimer cette charge?",
                icon: 'question',
                text: "Cette charge sera supprimée de façon définitive.",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Oui, supprimer!",
                cancelButtonText: "Non, annuler !",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    // if (confirm("Supprimer cette tâches?") == true) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('gestion.charge.delete') }}",
                        data: {id: id},
                        dataType: 'json',
                        success: function (res) {
                            if (res) {
                                swal.fire("Effectué!", "Supprimé avec succès!", "success")
                                table.row( $('#deletebtn'+id).parents('tr') )
                                    .remove()
                                    .draw();

                            } else {
                                sweetAlert("Désolé!", "Erreur lors de la suppression!", "error")
                            }

                        },
                        error: function (resp) {
                            sweetAlert("Désolé!", "Une erreur s'est produite.", "error");
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
            // }
        }

    </script>
    <!-- Datatable -->
    <script src="{{asset('template/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/js/plugins-init/datatables.init.js')}}"></script>
    <script src="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
@endsection
