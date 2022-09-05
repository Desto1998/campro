@extends('layouts.app')
@section('title','| Formation')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

@stop
@section('content')
    <div class="container-fluid dashboard-content">

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header" id="top">
                    <h2 class="pageheader-title">Formation </h2>
                    <p class="pageheader-text">Ajouter une formation</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tableau de bord</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link active">Ajout
                                        formation</a></li>
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
                    <h5 class="card-header bg-white">Ajout d'une Formation</h5>
                    <div class="card-body">
                        <form action="{{ route('formation.store') }}" method="post" id="basicform" data-parsley-validate="">
                            @csrf
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label class="nav-label">Informations de la formation</label>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="titre_for">Titre de la formation <span class="text-danger">*</span></label>
                                        <input type="text" name="titre_for" required="" placeholder="Entrez le titre de la formation"
                                               class="form-control" id="titre_for">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="cout_for">Coût de la formation <span class="text-danger">*</span></label>
                                        <input id="cout_for" type="number" step="any" name="cout_for"
                                               required="" placeholder="Entrez le coût de la formation"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="type_cout">Type de coût <span class="text-danger">*</span></label>

                                        <select class="form-control" required name="type_cout" id="type_cout">
                                            <option selected="selected" disabled>Sélectionnez un champ</option>
                                            <option>Honoraire</option>
                                            <option>Prestation</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="type_for">Type de formation <span class="text-danger">*</span></label>
                                        <select class="form-control" name="type_for" id="type_for" required>
{{--                                            <option selected="selected" disabled>Sélectionnez un champ</option>--}}
                                            <option>Qualifiante</option>
                                            <option>Non-Qualifiante</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="des_for">Description</label>
                                    <textarea class="form-control" name="des_for" id="des_for" placeholder="Description..."></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <h5>Soumis à un examen <span class="text-danger">*</span></h5>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="ex_for" checked="" value="Oui" class="custom-control-input"><span class="custom-control-label">Oui</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="ex_for" value="Non" class="custom-control-input"><span class="custom-control-label">Non</span>
                                    </label>
                                </div>
                                <label class="nav-label">Informations du formateur</label>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nom_for">Nom formateur <span class="text-danger">*</span></label>
                                        <input type="text" name="nom_for"
                                               required="" placeholder="" class="form-control" id="nom_for">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="prenom_for">Prenom formateur</label>
                                        <input id="prenom_for" type="text" name="prenom_for"
                                                placeholder="" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tel_for">Tel formateur <span class="text-danger">*</span></label>
                                        <input type="text" name="tel_for"
                                               required="" placeholder="" class="form-control" id="tel_for">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="id_four">Fournisseur <span class="text-danger">*</span></label>
                                        <select class="form-control" name="id_four" required id="id_four">
                                            <option selected="selected" disabled>Sélectionnez un champ</option>
                                            @foreach($four as $item)
                                                <option value="{{ $item->id_four }}">{{ $item->nom_four  }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="col-sm-12 pl-0">
                                        <p class="text-right">
                                            <button type="submit" class="btn btn-space btn-primary">Enregistrer</button>
                                            <button class="btn btn-space btn-danger">Annuler</button>
                                        </p>
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
