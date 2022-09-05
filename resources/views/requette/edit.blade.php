@extends('layouts.app')
@section('title','| Requete')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/vendor/select2/css/select2.min.css')}}">
@stop
@section('content')
    <div class="container-fluid dashboard-content">

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header" id="top">
                    <h2 class="pageheader-title">requête </h2>
                    <p class="pageheader-text">Creer une requête</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tableau de bord</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link active">Creer
                                        une requette</a></li>
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
                    <h5 class="card-header bg-white">Creer une requête</h5>
                    <div class="card-body">
                        <form action="{{ route('requette.store') }}" method="post" id="basicform" data-parsley-validate="">
                            @csrf
                            <input type="hidden" name="id_re" value="{{ $data->id_re }}">
{{--                            <input type="hidden" name="id_for" value="{{ $data->id_for }}">--}}
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                {{--                                <label class="nav-label">Informations de la formation</label>--}}
                                <div class="form-group">
                                    <label for="object_re">Objet <span class="text-danger">*</span></label>
                                    <input type="text" name="object_re" required="" placeholder="Objet..."
                                           class="form-control" id="object_re" value="{{ $data->object_re }}">
                                </div>
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-8"><label>Liste des formations</label></div>--}}
{{--                                    --}}{{--                                    <div class="col-md-4"><label>Compétence recherchée</label></div>--}}
{{--                                    <div class="col-md-4"><label>Date de formation</label></div>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="single-select">Formation <span class="text-danger"> *</span> </label>
                                    <select name="id_for" id="single-select" class="form-control" required>
                                        <option selected="selected" disabled>Sélectionez une formation</option>
                                        @foreach($formation as $form)
                                            <option
                                                value="{{ $form->id_formation }}">{{ $form->titre_for }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date_debut">Date formation</label>
                                    <input type="date" name="date_debut" class="form-control form-control-sm" required>
                                </div>

                                {{--                                @foreach($formation as $form)--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-8">--}}
{{--                                            <div class="form-group mt-4">--}}
{{--                                                <label title="{{ $form->des_for }}">--}}
{{--                                                    <input type="checkbox" name="id_for[]" value="{{ $form->id_formation }}" class="checked">--}}
{{--                                                    &nbsp;&nbsp; {{ $form->titre_for }}--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        --}}{{--                                        <div class="col-md-4">--}}
{{--                                        --}}{{--                                            <div class="form-group">--}}
{{--                                        --}}{{--                                                --}}{{----}}{{--                                                <label for="date_debut">Date formation</label>--}}
{{--                                        --}}{{--                                                <input type="text" name="competence[{{ $form->id_formation }}]" class="form-control form-control-sm">--}}
{{--                                        --}}{{--                                            </div>--}}
{{--                                        --}}{{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <div class="form-group">--}}
{{--                                                --}}{{--                                                <label for="date_debut">Date formation</label>--}}
{{--                                                <input type="date" name="date_debut[{{ $form->id_formation }}]" class="form-control form-control-sm">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}

                                {{--                                <div class="row">--}}
                                {{--                                    @foreach($domaine as $form)--}}
                                {{--                                        <div class="form-group col-md-6">--}}
                                {{--                                            <input type="checkbox" name="id_sousdo[]" value="{{ $form->id_sousdo }}" class="checked">--}}
                                {{--                                            &nbsp;&nbsp; {{ $form->titre_sousdo}}--}}
                                {{--                                        </div>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </div>--}}

                                <div class="form-group w-100">
                                    <label for="">Domaines</label>
                                    <select class="multi-select w-100" name="id_sousdo[]" multiple="multiple">
                                        {{--                                        <option selected disabled>Sélectionner un domaine</option>--}}
                                        @foreach($domaine as $form)
                                            <option value='{{ $form->id_sousdo }}'>{{ $form->titre_sousdo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group w-100">
                                    <label for="">Compétences recherchées</label>
                                    <textarea class="form-control" name="competence">{{ $infos[0]->competence }}</textarea>
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
    <script src="{{asset('template/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('template/js/plugins-init/select2-init.js')}}"></script>
@endsection
