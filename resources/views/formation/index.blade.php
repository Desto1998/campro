@extends('layouts.app')
@section('title','| Formations')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

@stop
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header" id="top">
                    <h2 class="pageheader-title">Gestion des formations </h2>
                    <p class="pageheader-text">Gerer les formation, creer, modifier, supprimer</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tableau de bord</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link active">Formations</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Liste</li>
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
                    <h5 class="card-header bg-white">Liste des formations</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered first text-center">
                                <thead class="bg-danger text-white">
                                <tr >
                                    <th>#</th>
                                    <th>Titre</th>
                                    <th>Type Form</th>
                                    <th>Description</th>
                                    <th>Type Cout</th>
                                    <th>Cout</th>
                                    <th>Formateur</th>
                                    <th>Fournisseur</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $value)
                                    @php $id_four = 0; @endphp
                                    <tr class="text-center" id="table-row-{{ $value->id_formation }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->titre_for }}</td>
                                        <td>{{ $value->type_for }}</td>
                                        <td>{{ $value->des_for}}</td>
                                        <td>{{ $value->type_cout }}</td>
                                        <td>{{ $value->cout_for }}</td>
                                        <td>
                                            @foreach($formateurs as $item)
                                                @if ($item->id_formation==$value->id_formation)
                                                    {{ $item->nom_for }} {{ $item->prenom_for }}
                                                    @php $id_four=$item->id_four; @endphp
                                                @endif

                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($fournisseurs as $item)
                                                @if ($item->id_four==$id_four)
                                                    {{ $item->nom_four }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="d-flex text-center justify-content-center">
                                                <a href="{{ route('formation.edit',['id'=>$value->id_formation]) }}" class="btn btn-warning btn-sm"
                                                   title="Modifier">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)" onclick="deleteFun({{ $value->id_formation }})"
                                                   class="btn btn-danger btn-sm ml-1" title="Supprimer">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>

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
    </div>
@endsection
@section('script')
    <script>
        function deleteFun(id) {
            swal.fire({
                title: "Supprimer cette formation?",
                icon: 'question',
                text: "cette formation sera supprimé de façon définitive.",
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
                        url: "{{ route('formation.delete') }}",
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
