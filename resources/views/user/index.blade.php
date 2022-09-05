@extends('layouts.app')
@section('title','| UTILISATEURS')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

@stop
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header" id="top">
                            <h4>Liste des utilisateurs</h4>
                            {{--                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>--}}
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Users</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card p-3">

                        <div class="card-body"><h4>Liste des utilisateurs</h4>

                            <a href="{{ route('user.add') }}" title="Ajouter un utilisateur"
                               class="btn btn-danger mb-3 float-right">
                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Nouveau
                            </a>
                            <div class="table-responsive">
                                <table id="example" class="display text-center w-100">
                                    <thead class="bg-danger">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Role</th>
                                        <th>Statut</th>
                                        <th>Crée le</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key=> $value)
                                        <tr id="table-row-{{ $value->id }}">
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->lastname }}</td>
                                            <td>{{ $value->firstname }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>
{{--                                                {{ $value->role }}--}}
                                                @if($value->is_admin>=1)
                                                    <span class="p-2 text-info">Administrateur</span>
                                                @endif
                                                @if($value->is_admin==0)
                                                    <span class="p-2 text-success">Utilisateur</span>
                                                @endif

                                            </td>
                                            <td>
                                                @if($value->is_active>=1)
                                                    <span class="p-2 text-info">Actif</span>
                                                @endif
                                                @if($value->is_active==0)
                                                    <span class="p-2 text-danger">Bloqué</span>
                                                @endif

                                            </td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('user.edit', ['id'=>$value->id]) }}"
                                                       class="btn btn-warning btn-sm" title="Modifier le compte"><i
                                                            class="fa fa-edit"></i></a>
                                                    @if(Auth::user()->id != $value->id)

                                                        <button class="btn btn-danger btn-sm ml-1 " title="Supprimer"
                                                                onclick="deleteUser({{ $value->id }})"><i
                                                                class="fa fa-trash"></i></button>

                                                        @if($value->is_active==1)

                                                            <a type="button" class="btn btn-dark ml-1 btn-sm"
                                                               href="{{ route('block_compte', ['id'=>$value->id]) }}"
                                                               title="Bloquer le compte">
                                                                <i class="fa fa-fw fa-lock"></i>
                                                            </a>

                                                        @endif
                                                        @if($value->is_active==0)

                                                            <a title="Activer le compte"
                                                               class="btn btn-success btn-sm ml-1"
                                                               href="{{ route('activate_compte', ['id'=>$value->id]) }}"
                                                               id="activate-user">
                                                                <i class="fa fa-fw fa-check"></i>
                                                            </a>

                                                        @endif
                                                    @endif
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
    </div>

@endsection
@section('script')
    <script>
        function deleteUser(id) {
            swal.fire({
                title: "Supprimer cette compte?",
                icon: 'question',
                text: "Ce compte sera supprimé de façon définitive.",
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
                        url: "{{ route('user.delete') }}",
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
