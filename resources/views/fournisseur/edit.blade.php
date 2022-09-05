@extends('layouts.app')
@section('title','| Foutnisseur')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

@stop
@section('content')
    <div class="container-fluid dashboard-content">

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header" id="top">
                    <h2 class="pageheader-title">Fournisseur </h2>
                    <p class="pageheader-text">Editer un fournisseur</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tableau de bord</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link active">Editer
                                        fournisseur</a></li>
                                <!-- <li class="breadcrumb-item active" aria-current="page">Form Elements</li> -->
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center d-flex">
            <!-- ============================================================== -->
            <!-- basic form -->
            <!-- ============================================================== -->
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header bg-white">Editer un fournisseur</h5>
                    <div class="card-body">
                        <form action="{{ route('fournisseur.update') }}" method="post" id="basicform"
                              data-parsley-validate="">
                            @csrf
                            <input type="hidden" name="id_four" value="{{ $data->id_four }}">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="inputUserName">Nom de l'entreprise</label>
                                        <input id="inputUserName" type="text" value="{{ $data->nom_four }}" name="nom" data-parsley-trigger="change"
                                               required="" placeholder="Entrez le nom de l'entreprise"
                                               autocomplete="off" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">Addresse Email</label>
                                        <input id="inputEmail" type="email" name="email" data-parsley-trigger="change"
                                               required="" placeholder="Entrer l'email" autocomplete="off"
                                               class="form-control" value="{{ $data->email_four }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName">Téléphone</label>
                                        <input id="inputUserName" type="text" name="tel" data-parsley-trigger="change"
                                               required="" placeholder="Entrez votre numéro" autocomplete="off"
                                               class="form-control" value="{{ $data->tel_four }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName">Type de fournisseur</label>
                                        <div class="form-group">
                                            <select class="form-control form-control-sm" name="type">
                                                <option selected="selected" disabled>Sélectionnez un champ</option>
                                                <option>Interne</option>
                                                <option>Externe</option>
                                                <option>Mixte</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

                                        <div class="col-sm-12 pl-0">
                                            <p class="text-right">
                                                <button type="submit" class="btn btn-space btn-primary">Enregistrer
                                                </button>
                                                <button class="btn btn-space btn-danger">Annuler</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end basic form -->
            <!-- ============================================================== -->

        </div>
    </div>
@endsection
@section('script')

    <!-- Datatable -->
    <script src="{{asset('template/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/js/plugins-init/datatables.init.js')}}"></script>
    <script src="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>

@endsection
