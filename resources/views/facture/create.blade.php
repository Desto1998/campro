@extends('layouts.app')
@section('title','| FACTURE-CREER')
@section('css_before')
    <link rel="stylesheet" href="{{asset('template/vendor/select2/css/select2.min.css')}}">
    <style>
        .hidden {
            display: none;
        }
        .enterprisehide{
            display: none;
        }
    </style>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Créer une facture</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Factures</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Ajouter</a></li>
                </ol>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        {{--                        <h4 class="w-50">Ajouter un devis</h4>--}}
                        <form action="{{ route('factures.store') }}" method="post" id="devis-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 float-left d-flex">
                                    <div class="form-group col-md-6">
                                        <label for="date">Date de la facture <span class="text-danger"> *</span> </label>
                                        <input type="date" name="date" id="date" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="statut_tva">Inclure la TVA? <span class="text-danger">*</span></label>
                                        <select class="form-control" name="tva_statut">
                                            <option value="0">Non</option>
                                            <option value="1">Oui</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7 float-right d-flex" id="client-block">
                                    <div class="form-group col-md-6">
                                        <label for="echeance">Client  <span class="text-danger">*</span></label>
                                        <select name="idclient" id="single-select" class="form-control" required>
                                            <option selected="selected" disabled>Sélectionez un client</option>
                                            @foreach($clients as $cl)
                                                <option
                                                    value="{{ $cl->client_id }}">{{ $cl->nom_client }} {{ $cl->prenom_client }}{{ $cl->raison_s_client }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="client-block">
                                        <label class="text-center pl-3">Coordonnées du client &nbsp;&nbsp;
                                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                                    title="Ajouter un client"
                                                         data-target="#clientsModal"><i class="fa fa-plus">&nbsp;</i>
                                            </button>
                                        </label>
                                        @foreach($clients as $cl)
                                            <div class="hidden infos_client pl-3" id="infos_client{{ $cl->client_id }}">
                                                <label
                                                    class="h5 font-weight-bold mt-1">{{ $cl->nom_client }} {{ $cl->prenom_client }}{{ $cl->raison_s_client }}</label><br>
                                                <label
                                                    class="h5 font-weight-bold mt-1">Tel: {{ $cl->phone_1_client }}  {{ $cl->phone_client }}</label><br>
                                                <label
                                                    class="h5 font-weight-bold mt-1">Bp: {{ $cl->postale }}</label><br>
                                                {{--                                                <label class="h5 font-weight-bold mt-1"> {{ $cl->rcm }}</label><br>--}}
                                                {{--                                                <label class="h5 font-weight-bold mt-1">NC: {{ $cl->contribuabe }}</label><br>--}}
                                            </div>

                                        @endforeach
                                    </div>


                                </div>


                            </div>
                            <div class="form-group">
                                <label for="objet">Objet <span class="text-danger"> *</span> </label>
                                <input type="text" name="objet" id="objet" class="form-control" required>
                            </div>
                            <div class="for-produit table-responsive" style="max-height: 300px; overflow: auto">
                                <label class="nav-label">Produits</label>
                                <table class="w-100 table table-striped table-bordered table-active" id="table-produit">
                                    <thead class="bg-primary text-white text-center">
                                    <tr>
                                        <th>Désignation</th>
                                        <th>Qté</th>
                                        <th>P.U.HT.</th>
                                        <th>Remise(%)</th>
{{--                                        <th>TVA</th>--}}
                                        <th>M. HT(FCFA)</th>
{{--                                        <th>M. TTC</th>--}}
                                        <th><i class="fa fa-trash"></i></th>
                                    </tr>

                                    </thead>
                                    <tbody style="color: #000000!important;">
                                    <tr class="text-black  produit-input font-weight-bold" id="product-row0">
                                        <td style="width: 270px;">
                                            <select name="idproduit[]" class="dropdown-groups form-control" id="select-pro0" onchange="setPrix(0)" style="color: #000000">
                                                <option selected="selected" disabled>Sélectionez un produit</option>
                                                @foreach($categories as $cat)
                                                    <optgroup class="" label="{{ $cat->titre_cat }}">
                                                        @foreach($produits as $p)
                                                            @if ($p->idcategorie===$cat->categorie_id)
                                                                <option
                                                                    value="{{ $p->produit_id }}">{{ $p->titre_produit }}</option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" min="0" value="0" name="quantite[]" onchange="calculeHT(0)" id="quantite0" class="form-control quantite"
                                                   required></td>
                                        <td><input type="number" min="0" value="0" name="prix[]" onchange="calculeHT(0)" id="prix0" class="form-control prix"
                                                   required></td>
                                        <td><input type="number" min="0" value="0" name="remise[]" onchange="calculeHT(0)" step="any" id="remise0"
                                                   class="form-control remise" required></td>
{{--                                        <td><input type="number" min="0" value="0" name="tva[]" step="any" id="tva0" onchange="calculeHT(0)"--}}
{{--                                                   class="form-control tva" required></td>--}}
                                        <td><input type="number" min="0" readonly  name="totalHT[]" value="0" step="any" id="totalHT0"
                                                   class="form-control totalHT"></td>
{{--                                        <td><input type="number" min="0" value="0" readonly name="totalTTC[]" step="any" id="totalTTC0"--}}
{{--                                                   class="form-control totalTTC"></td>--}}
                                        <td class="text-center">
                                            <button type="button" onclick="removeLigne(0)"
                                                    class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 d-flex">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-sm btn-primary" id="add-row-produit"><i
                                            class="fa fa-plus"></i> Ajouter une ligne
                                    </button>
                                </div>

                                <div class="col-md-9 d-flex">
                                    <div class="d-flex form-group col-md-4">
                                        <label class="text-center">Montant HT &nbsp;&nbsp;</label>
                                        <input type="number" readonly name="ht" value="0" id="ht" class="form-control">
                                    </div>
                                    <div class="d-flex form-group col-md-4">
                                        <label class="text-center">Montant TVA &nbsp;&nbsp;</label>
                                        <input type="number" readonly name="mtva" id="mtva" value="0" class="form-control">
                                    </div>
                                    <div class="d-flex form-group col-md-4">
                                        <label class="text-center">Montant TTC &nbsp;&nbsp;</label>
                                        <input type="number" readonly name="ttc" id="ttc" value="0" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 row">
                                <div class="col-md-6">
                                    <label class="nav-label text-center">Informations du bon de commande</label>
                                    <div class="form-group">
                                        <label for="ref_bon">Reference du bon de commande</label>
                                        <input type="text" name="ref_bon" id="ref_bon" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>date du bon de commande</label>
                                        <input type="date"  name="date_bon" id="ref_bon" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="logo-upload">Joindre un fichier</label>
                                        <input type="file" name="logo" id="logo-upload" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-3 ml-5" title="Cliquer pour selectioner une image">
                                        <img id="logo-zone" style="width: 300px; height: 300px; min-height: 200px; min-width: 200px" src="{{ asset('images/logo-thumbnail.png') }}" alt="Ouopps! Auncune image disponible">
                                    </div>
{{--                                    <div class="kv-avatar-hint">--}}
{{--                                        <small>Sélectionner un fichier< 1500 KB</small>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{--    ici on garde les donnees des produit pour ne pas attaquer le serveur a chaque fois--}}
    @foreach($produits as $p)

        <input type="hidden" name="produit_idproduit" value="{{ $p->produit_id }}" id="data_p_idproduit{{ $p->produit_id }}">
        <input type="hidden" name="produit_reference" value="{{ $p->reference }}" id="data_p_reference{{ $p->produit_id }}">
        <input type="hidden" name="produit_prix" value="{{ $p->prix_produit }}" id="data_p_prix{{ $p->produit_id }}">
        <input type="hidden" name="produit_quantite" value="{{ $p->quantite_produit }}" id="data_p_quantite{{ $p->produit_id }}">
        <input type="hidden" name="produit_categorie" value="{{ $p->idcategorie }}" id="data_p_categorie{{ $p->idcategorie }}">

    @endforeach
    @include('client.modal')
@endsection
@section('script')
    <script>
        //  variabes qui comptes les entrees
        var totalProduit = 0;
        var totalComplement = 0;
        $(document).ready(function () {
            // ici on affiche les informations du client en fonction du client selectionneee

            $('#single-select').on('change', function (e) {
                var idclient = $('#single-select').val();
                // on cache d'abord toutes les infos client
                $('.infos_client').hide(200);
                //on affiche l'info client correspondant
                $('#infos_client' + idclient).show(250);
            });

            // cette methode ajoute une nouvelle ligne de produit sur le tableau
            $('#add-row-produit').on('click', function (e) {

                totalProduit++;
                var cloned = $("#table-produit tbody").find("tr").first().clone();
                var id = 'product-row' + totalProduit;
                // $('.dropdown-groups').val(null).trigger('change');
                var selectid = 'select-pro' + totalProduit;
                var row = '<tr class="text-black  produit-input font-weight-bold" id="' + id + '">' +
                    '<td style="width: 270px;">' +
                    '<select onchange="setPrix('+totalProduit+')" class="dropdown-groups form-control" id="' + selectid + '" style="color: #000000" name="idproduit[]">'+
                    '<option selected="selected" disabled>Sélectionez un produit</option>';
                row += '@foreach($categories as $cat)' +
                    '<optgroup class="" label="{{ $cat->titre_cat }}">' +
                    '@foreach($produits as $p)' +
                    ' @if ($p->idcategorie===$cat->categorie_id)' +
                    '<option value="{{ $p->produit_id }}">{{ $p->titre_produit }}</option>' +
                    '@endif' +
                    ' @endforeach' +
                    '</optgroup>' +
                    ' @endforeach' +
                    '</select>' +
                    ' </td>';
                row += '<td><input type="number" min="0" name="quantite[]" value="0" onchange="calculeHT('+totalProduit+')" id="quantite'+totalProduit+'" class="form-control quantite" required></td>' +
                    '<td><input type="number" min="0" name="prix[]" value="0" onchange="calculeHT('+totalProduit+')" id="prix'+totalProduit+'" class="form-control prix" required></td>' +
                    '<td><input type="number" min="0" name="remise[]" value="0" onchange="calculeHT('+totalProduit+')" id="remise'+totalProduit+'" step="any" class="form-control remise" required></td>' +
                    '<td><input type="number" min="0" value="0"  readonly name="totalHT[]" id="totalHT'+totalProduit+'" step="any" class="form-control totalHT" ></td>' +
                    '<td class="text-center"><button type="button" onclick="removeLigne(' + totalProduit + ')" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button></td>' +
                    '</tr>';
                // '<td><input type="number" min="0" value="0" readonly name="totalTTC[]" id="totalTTC'+totalProduit+'" step="any" class="form-control totalTTC" ></td>' +
                //  '<td><input type="number" min="0"  name="tva[]" value="0" onchange="calculeHT('+totalProduit+')"  id="tva'+totalProduit+'" step="any" class="form-control tva" required></td>' +
                $('#table-produit tbody').append(row);

                $('#' + selectid).select2();
            });
        });


        // cette fonction retire une ligne dans le tableau de produit
        function removeLigne(number) {

            if ($('#table-produit tbody').find("tr").length > 1) {
                $('#product-row' + number).remove();
                total();
            } else {
                alert("Vous ne pouvez pas supprimer tous les elements.");
            }
        }


        // fontion qui charge le prix d'un produit
        function setPrix(number) {
            var productId =  $('#select-pro'+number).val();
            var defaultPrice = $('#data_p_prix'+productId).val();
            $('#prix'+number).val(defaultPrice);
        }


        // fonction qui calcule le montant HT  par produit
        function calculeHT(number){

            var remise =0;
            var qte =0;
            var prix =0;
            var tva = 0;
            if ($('#select-pro'+number).val()){
                if ($('#remise'+number).val()!=''){
                    remise = $('#remise'+number).val()
                }
                if ($('#quantite'+number).val()!=''){
                    prix = $('#quantite'+number).val()
                }
                if ($('#prix'+number).val()!=''){
                    qte = $('#prix'+number).val()
                }

                // if ($('#tva'+number).val()!=''){
                //     tva = $('#tva'+number).val()
                // }
                if ($('select[name="tva_statut"]').val()==1){
                    tva = 19.25;
                }
                var montant = (qte*prix) - (qte*prix*remise)/100 ;

                var ttc = (montant * tva )/100 + montant;
                ttc = Number(ttc).toFixed(2) ;
                montant =Number(montant).toFixed(2)
                $('#totalHT'+number).val(montant);
                // $('#totalTTC'+number).val(ttc);
                total();
            }
        }


        $('select[name="tva_statut"]').on('change',function (e){
            if ($('select[name="tva_statut"]').val()==1){
                total();
            }
        });
        // fonction qui calcule les totaux HT et TTC
        function total(){
            var totalht = 0;
            var totalttc = 0;
            var tva = 0;
            $('input[name="totalHT[]"]').each(function (){
                totalht += Number($(this).val());
            });
            // $('input[name="totalTTC[]"]').each(function (){
            //     totalttc +=Number( $(this).val());
            // });
            if ($('select[name="tva_statut"]').val()==1){
                tva = 19.25;
            }
            var mtva = (totalht * tva )/100;
            mtva = Number(mtva).toFixed(2)
            $('#mtva').val(mtva);
            $('#ht').val(Number(totalht).toFixed(2));
            // $('#ttc').val(Number(totalht+mtva).toFixed(2));
            var mttc = parseFloat(totalht) + parseFloat(mtva);
            $('#ttc').val(mttc);
        }

        // traitement de l'image
        $("#logo-zone").click(function(e) {
            $("#logo-upload").click();
        });
        function fasterPreview( uploader ) {
            if ( uploader.files && uploader.files[0] ){
                $('#logo-zone').attr('src',
                    window.URL.createObjectURL(uploader.files[0]) );
            }
        }
        $("#logo-upload").change(function(){
            fasterPreview( this );
        });
        $('#edit-btn').click(function (e){
            $('.form-control').removeAttr('disabled');
            $('.btn-primary').removeAttr('disabled');
        });

        // function d'ajout du client

        function filterFormInput(){
            var type = $('#type_client').val();
            if (type==1){
                $('.enterprisehide').show(200)
                $('.clienthide').hide(200)
                $('#nom_client').prop('required',false)
                $('#raison_s_client').prop('required',true)
                $('#raison_s_client').attr('disabled',false)
                $('#nom_client').attr('disabled',true)
                $('#rcm').prop('required',true)
                $('#rcm').attr('disabled',false)
                $('#contribuabe').attr('disabled',false)
            }else {
                $('#raison_s_client').prop('required',false)
                $('#raison_s_client').attr('disabled',true)
                $('.enterprisehide').hide(200)
                $('.clienthide').show(200)
                $('#nom_client').prop('required',true)
                $('#nom_client').attr('disabled',false)
                $('#rcm').attr('disabled',true)
                $('#contribuabe').attr('disabled',true)
            }

        }

        $("#client-form").on("submit", function (event) {
            event.preventDefault();

            $('#client-form .btn-primary').attr("disabled", true).html("En cours...")
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data = $('#client-form').serialize()

            $.ajax({
                type: "POST",
                url: "{{ route('client.store') }}",
                data: data,
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if (res) {

                        toastr.success("Enregistré avec succès!");
                        $('.infos_client').hide(200);
                       var option =' <option selected value="'+res.client_id+'">'+ res.nom_client +' ' + res.prenom_client +' '+ res.raison_s_client +'</option>'
                        $('#single-select').append(option).select2();
                       // $('#single-select').select2();
                       var data = '<div class="hidden infos_client pl-3" id="infos_client'+res.client_id+'">';
                        data += '<label class="h5 font-weight-bold mt-1">'+ res.nom_client +' ' + res.prenom_client +' '+ res.raison_s_client +'</label><br>'
                        data += '<label class="h5 font-weight-bold mt-1">Tel: '+ res.phone_1_client +  ' / ' + res.phone_2_client +'</label><br>'
                        data += '  <label class="h5 font-weight-bold mt-1">Bp:'+ res.postale +'</label><br>'
                        data += '</div>';
                        $('#client-block').append(data);
                        $('#infos_client'+res.client_id).show(100);
                        // on reinitialise le formulaire
                        $('#client-form .btn-primary').attr("disabled", false).html("Enregistrer")
                        $('#client-form')[0].reset()
                        $('#clientsModal').modal('hide');

                    } else {
                        sweetAlert("Désolé!", "Erreur lors de l'enregistrement!", "error")
                        $('#client-form .btn-primary').attr("disabled", false).html("Enregistrer")
                    }

                },
                error: function (resp) {
                    sweetAlert("Désolé!", "Une erreur s'est produite.", "error");
                    $('#client-form .btn-primary').attr("disabled", false).html("Enregistrer")
                }
            });
        });
    </script>

    <!-- Selet search -->
    <script src="{{asset('template/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('template/js/plugins-init/select2-init.js')}}"></script>

@endsection
