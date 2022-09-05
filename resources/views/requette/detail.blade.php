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
                    <h2 class="pageheader-title">Detail requete </h2>
                    <p class="pageheader-text">Gerer les requetes, creer, modifier, supprimer</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tableau de bord</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link active">Requetes</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                    <h5 class="card-header bg-white">Detail des requetes</h5>
                    <div class="card-body">
{{--                        <form action="{{ route('requette.print') }}" method="get" class="mb-4">--}}
{{--                            <center>--}}
{{--                                <div class="d-flex justify-content-center col-md-6">--}}
{{--                                    --}}{{--                                <div class="row"></div>--}}
{{--                                    <label>Début</label>&nbsp;&nbsp;--}}
{{--                                    <input type="date" max="{{ date('Y-m-d') }}" required class="form-control form-control-sm" name="debut">--}}
{{--                                    &nbsp;&nbsp;&nbsp;&nbsp;<label>Fin</label>&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--                                    <input type="date" max="{{ date('Y-m-d') }}" required class="form-control form-control-sm" name="fin">--}}
{{--                                    &nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-sm">Imprimer</button>--}}
{{--                                </div>--}}
{{--                            </center>--}}

{{--                        </form>--}}
                        <div class="">
                            <table id="example" class="table table-striped table-bordered first text-center">
                                <tr>
                                    <td>Objet</td>
                                    <td>{{ $data->object_re }}</td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                     <td>{{ $data->date_re }}</td>
                                </tr>
                                <tr>
                                    <td>Employé</td>
                                    <td>{{ $employes->firstname }} {{ $employes->lastname }}</td>
                                </tr>

                                <tr>
                                    <td>Formation</td>
                                    <td>
                                        @foreach($formations as $item)
                                            @if ($item->id_re==$data->id_re)
                                                {{ $item->titre_for }}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>$infos = DateFormation::where('id_re',$id)->get();
                                    <td>Compétences recherchées</td>
                                    <td>{{ $infos[0]->competence }}</td>
                                </tr>
                                <tr>
                                    <td>Domaine</td>
                                    <td>
                                        @foreach($sousdo as $item)
                                            @if ($item->id_re==$data->id_re)
                                                {{ $item->titre_sousdo }}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Durée</td>
                                    <td>{{ $data->dure_re }}</td>
                                </tr>
                                <tr>
                                    <td>Statut</td>
                                    <td>
                                        @if (1==$data->statut)
                                            <span class="text-success">Validé</span>
                                        @elseif(2==$data->statut)
                                            <span class="text-danger">Rejeté</span>
                                        @else
                                            <span class="text-warning">En attente</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Commentaire</td>
                                    <td>{{ $data->description }}</td>
                                </tr>
                                @if (2==$data->statut)
{{--                                    <span class="text-success">Validé</span>--}}
                                @else
                                    <tr>
                                        <td>Date debut</td>
                                        <td>{{ $data->date_debut }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date fin</td>
                                        <td>{{ $data->date_fin }}</td>
                                    </tr>
                                @endif

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

    </script>
    <!-- Datatable -->
    <script src="{{asset('template/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/js/plugins-init/datatables.init.js')}}"></script>
    <script src="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>

@endsection
