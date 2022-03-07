@extends('layouts.app')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/vendor/select2/css/select2.min.css')}}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Produits</h4>
                    {{--                    <p class="mb-0">Your business dashboard template</p>--}}
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Produit</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Index</a></li>
                </ol>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <h4 class="w-50">Liste des produits</h4>
                        <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal"
                                data-target="#produitsModal"><i class="fa fa-plus">&nbsp; Ajouter</i></button>

                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                <tr>
                                <tr>
                                    <th>#</th>
                                    <th>Reference</th>
                                    <th>Titre</th>
                                    <th>Catégorie</th>
                                    <th>description</th>
                                    <th>Crée Par</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key=> $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->reference }}</td>
                                        <td>{{ $value->titre_produit }}</td>
                                        <td>{{ $value->titre_cat }}</td>
                                        <td>{{ $value->description_produit }}</td>
                                        <td>{{ $value->firstname }}</td>
                                        <td class="d-flex">
                                            <a href="#" class="btn btn-warning btn-sm" title="Modifier le produit"
                                               data-toggle="modal" data-target="#produitsModal{{ $value->produit_id }}"><i
                                                    class="fa fa-edit"></i></a>
                                            @if (Auth::user()->is_admin==1)
                                                <button class="btn btn-danger btn-sm ml-1 "
                                                        title="Supprimer ce produit"
                                                        onclick="deleteFun({{ $value->produit_id }})"><i
                                                        class="fa fa-trash"></i></button>
                                                {{--                                            Auth::user()->id--}}
                                            @endif
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="produitsModal{{ $value->produit_id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modifier un produit</h5>

                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('produit.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="produit_id"
                                                               value="{{ $value->produit_id }}">
                                                        <input type="hidden" name="reference"
                                                               value="{{ $value->reference }}">

                                                        <div class="form-group">
                                                            <label for="titre_produit{{ $value->produit_id }}">Titre un produit<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="titre_produit"
                                                                   id="titre_produit{{ $value->produit_id }}"
                                                                   value="{{ $value->titre_produit }}" placeholder="Titre"
                                                                   class="form-control">
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="categorie{{ $value->produit_id }}">Charges <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" required name="idcategorie"
                                                                    id="categorie{{ $value->produit_id }}">
                                                                <option disabled="disabled" selected>Sélectionner une
                                                                    charge
                                                                </option>
                                                                @foreach($categories as $item)
                                                                    <option
                                                                        {{ $item->categorie_id==$value->idcategorie?'selected':'' }} value="{{ $item->categorie_id }}">{{ $item->titre_cat }} => {{ $item->code_cat }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description_produit">Description du produit </label>
                                                            <textarea name="description_produit" id="description_produit" placeholder="Description"
                                                                      class="form-control">{{ $value->description_produit }}</textarea>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Annuler
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Enregistrer
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="produitsModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un produit</h5>

                </div>
                <div class="modal-body">
                    <form action="{{ route('produit.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="titre_produit">Titre du produit<span class="text-danger">*</span></label>
                            <input type="text" name="titre_produit" id="titre_produit" placeholder="Titre" class="form-control"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="categorie">Catégorie <span class="text-danger">*</span></label>
                            <select class="form-control" required name="idcategorie" id="single-select">
                                <option disabled="disabled" selected>Sélectionner une catégorie</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item->categorie_id }}">{{ $item->titre_cat }} => {{ $item->code_cat }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description_produit">Description du produit </label>
                            <textarea name="description_produit" id="description_produit" placeholder="Description"
                                      class="form-control"></textarea>
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

@endsection
@section('script')
    <script>
        // delete funtion
        function deleteFun(id) {
            swal.fire({
                title: "Supprimer ce produit?",
                icon: 'question',
                text: "Ce produit sera supprimé de façon définitive.",
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
                        url: "{{ route('produit.delete') }}",
                        data: {id: id},
                        dataType: 'json',
                        success: function (res) {
                            if (res) {
                                swal.fire("Effectué!", "Supprimé avec succès!", "success")
                                window.location.reload(200);

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
    <!-- Selet search -->
    <script src="{{asset('template/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('template/js/plugins-init/select2-init.js')}}"></script>

@endsection
