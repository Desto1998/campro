@extends('layouts.app')
@section('title','| GESTION DES REQUETE')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
@stop
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header" id="top">
                    <h2 class="pageheader-title">Gestion des requetes </h2>
                    <p class="pageheader-text">Gerer les requetes, creer, modifier, supprimer</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tableau de bord</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link active">Requetes</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Gestion</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- ============================================================== -->
            <!-- basic form -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header bg-white">Liste des requetes</h5>
                    <div class="card-body">
                        <form action="{{ route('requette.print') }}" method="get" class="mb-4">
                            <center>
                                <div class="d-flex justify-content-center col-md-6">
                                    {{--                                <div class="row"></div>--}}
                                    <label>Début</label>&nbsp;&nbsp;
                                    <input type="date" max="{{ date('Y-m-d') }}" required class="form-control form-control-sm" name="debut">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<label>Fin</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="date" max="{{ date('Y-m-d') }}" required class="form-control form-control-sm" name="fin">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<label>Statut</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <select class="form-control" name="statut" id="statut">
                                        <option value="2">Rejeté</option>
                                        <option value="1">Validé</option>
                                        <option value="0">Tout statut</option>
                                    </select>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-sm">Imprimer</button>
                                </div>
                            </center>

                        </form>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered first text-center">
                                <thead class="bg-danger text-white">
                                <tr >
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Objet</th>
                                    <th>Demandeur</th>
                                    <th>Statut</th>
                                    <th>Formations</th>
                                    <th>Domaines</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $value)
                                    @php $id_four = 0; @endphp
                                    <tr class="text-center" id="table-row-{{ $value->id_re }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->date_re }}</td>
                                        <td>{{ $value->object_re }}</td>
                                        <td>
                                            @foreach($personnels as $item)
                                                @if ($item->id==$value->id_emp)
                                                    {{ $item->firstname }} {{ $item->lastname }}
                                                    @php $id_four=$item->id_four; @endphp
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if (1==$value->statut)
                                                <span class="text-success">Validé</span>
                                            @elseif(2==$value->statut)
                                                <span class="text-danger">Rejeté</span>
                                            @else
                                                <span class="text-warning">En attente</span>
                                            @endif
                                        </td>

                                        <td>
                                            @foreach($formations as $item)
                                                @if ($item->id_re==$value->id_re)
                                                    {{ $item->titre_for }}<br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($sousdo as $item)
                                                @if ($item->id_re==$value->id_re)
                                                    {{ $item->titre_sousdo }}<br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="d-flex text-center justify-content-center">
                                                <a href="{{ route('requette.show',['id'=>$value->id_re]) }}" class="btn btn-success btn-sm ml-1"
                                                   title="Voir plus">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if (0==$value->statut)
{{--                                                    <a href="{{ route('requette.valider',['id'=>$value->id_re]) }}" class="btn btn-success btn-sm ml-1"--}}
{{--                                                       title="Valider la requete" class="dropdown-item" data-toggle="modal"--}}
{{--                                                       data-target="#validerModal">--}}
{{--                                                        <i class="fa fa-check"></i>--}}
{{--                                                    </a>--}}
                                                    <a href="javascript:void(0);" class="btn btn-success btn-sm ml-1"
                                                       title="Valider la requete"data-toggle="modal"
                                                       data-target="#validerModal{{$value->id_re}}">
                                                        <i class="fa fa-check"></i>
                                                    </a>
{{--                                                    <a type="submit" class="dropdown-item" data-toggle="modal"--}}
{{--                                                       data-target="#validerModal">--}}
{{--                                                        <i class="fas fa-power-off mr-2"></i>--}}
{{--                                                        <span class="ml-2">Se déconnecter </span>--}}
{{--                                                    </a>--}}
{{--                                                    <a href="{{ route('requette.rejeter',['id'=>$value->id_re]) }}" class="btn btn-dark btn-sm ml-1"--}}
{{--                                                       title="Rejetter">--}}
{{--                                                        <i class="fa fa-briefcase"></i>--}}
{{--                                                    </a>--}}
                                                    <a href="javascript:void(0);" class="btn btn-dark btn-sm ml-1"
                                                       title="Rejeter la requete"data-toggle="modal"
                                                       data-target="#rejeterModal{{$value->id_re}}">
                                                        <i class="fa fa-briefcase"></i>
                                                    </a>
{{--                                                @elseif(0==$value->statut)--}}

                                                @else
{{--                                                    <a href="{{ route('requette.attente',['id'=>$value->id_re]) }}" class="btn btn-secondary btn-sm ml-1"--}}
{{--                                                       title="Mettre en attente de validation">--}}
{{--                                                        <i class="fa fa-archive"></i>--}}
{{--                                                    </a>--}}
                                                @endif
                                                <a href="javascript:void(0)" onclick="deleteFun({{ $value->id_re }})"
                                                   class="btn btn-danger btn-sm ml-1" title="Supprimer">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                    <div class="modal fade" id="rejeterModal{{$value->id_re}}">

                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">rejeter la requete?</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form  action="{{ route('requette.rejet') }}" method="POST" class="d-none">
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="id_re" value="{{ $value->id_re }}">
{{--                                                        <div class="form-group">--}}
{{--                                                            <label>Date de debut</label>--}}
{{--                                                            <input type="date" name="date" value="" class="form-control">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label>Date de fin</label>--}}
{{--                                                            <input type="date" name="fin" value="" class="form-control">--}}
{{--                                                        </div>--}}
                                                        <div class="form-group">
                                                            <label>Commentaire</label>
                                                            <textarea class="form-control" name="description"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <button class="btn btn-primary" type="submit">
                                                                {{ __('Valider') }}
                                                            </button>
                                                            {{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    {{-- Valider model --}}
                                    <div class="modal fade" id="validerModal{{$value->id_re}}">

                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Valider la requete?</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form  action="{{ route('requette.valid') }}" method="POST" class="d-none">
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="id_re" value="{{ $value->id_re }}">
                                                        <div class="form-group">
                                                            <label>Date de debut</label>
                                                            <input type="date" name="date" value="" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Date de fin</label>
                                                            <input type="date" name="fin" value="" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" name="description"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <button class="btn btn-primary" type="submit">
                                                                {{ __('Valider') }}
                                                            </button>
                                                            {{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
                                                        </div>
                                                    </div>
                                                </form>

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
@endsection
@section('script')
    <script>
        function deleteFun(id) {
            swal.fire({
                title: "Supprimer cette requete?",
                icon: 'question',
                text: "cette requete sera supprimé de façon définitive.",
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
                        url: "{{ route('requette.delete') }}",
                        data: {id: id},
                        dataType: 'json',
                        success: function (res) {
                            if (res) {
                                swal.fire("Effectué!", "Supprimé avec succès!", "success")
                                $('#table-row-' + id).hide(100)

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
