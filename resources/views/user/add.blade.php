@extends('layouts.app')
@section('title','| USER-ADD')
@section('css_before')

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
                            <h4>Créer un utilisateur</h4>
{{--                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>--}}
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item text-danger"><a href="javascript:void(0)">Dashboard</a></li>
                                        <li class="breadcrumb-item active text-danger"><a href="javascript:void(0)">Users</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="row justify-content-center d-flex">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="card p-3">
                            <div class="card-header bg-white">
                                <h4>Créer un utilisateur</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('user.add.store') }}" id="registerForm">
                                    @csrf

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="lastname" class="">{{ __('Nom') }}&nbsp;<span
                                                    class="text-danger">*</span></label>

                                            <input id="lastname" type="text"
                                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                                   value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="firstname" class="">{{ __('Prenom') }}</label>

                                            <input id="firstname" type="text"
                                                   class="form-control @error('name') is-invalid @enderror" name="firstname"
                                                   value="{{ old('firstname') }}" autocomplete="firstname" autofocus>

                                            @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="email" class="">{{ __('Email') }}&nbsp;<span
                                                    class="text-danger">*</span></label>


                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                                   value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>


                                        <div class="form-group col-md-6">
                                            <label for="cf-phone">{{ __('Téléphone') }} &nbsp;<span
                                                    class="text-danger">*</span></label>

                                            <input id="cf-phone" name="phone" type="tel"
                                                   class="form-control @error('phone') is-invalid @enderror" minlength="8"
                                                   maxlength="14" required>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="role">Role <span class="text-danger">*</span></label>
                                            <select name="role" class="form-control" id="role">
                                                <option value="2">Employé</option>
                                                <option value="1">Gestionnaire</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password" class="">{{ __('Mot de passe') }}&nbsp;<span
                                                    class="text-danger">*</span></label>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                                   required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="row col-md-12">
                                        <div class="form-group col-md-6">
                                            <label for="inputUserName">Sexe</label>
                                            <select class="form-control" name="sexe">
                                                <option selected="selected" disabled>Sélectionnez un champ</option>
                                                <option>Féminin</option>
                                                <option>Masculin</option>

                                            </select>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputUserName">Type d'utilisateur</label>
                                            <select class="form-control" name="ent_emp">
                                                <option selected="selected" disabled>Sélectionnez un champ</option>
                                                <option>Agent CAMRAIL</option>
                                                <option>Prestataire de service</option>
                                                <option>Stagiaire</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row col-md-12">
                                        <div class="form-group col-md-6">
                                            <label for="inputUserName">Catégorie</label>
                                            <select class="form-control" name="ca_emp">
                                                <option>Exécution</option>
                                                <option>Maitrise</option>
                                                <option>Cadre</option>
                                                <option>Non concerné</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputUserName">Service</label>
                                            <input id="inputUserName" type="text" name="lieus" data-parsley-trigger="change" required="" placeholder="Entrez le service" autocomplete="off" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row pt-1 pt-sm-1 mt-2">
                                        <div class="col-sm-12 pl-0">
                                            <p class="text-right">
                                                <button type="submit" class="btn btn-space btn-primary">Enregistrer</button>
                                                <button type="reset" class="btn btn-space btn-danger">Annuler</button>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop

@section('script')

@endsection
