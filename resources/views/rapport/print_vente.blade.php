<!DOCTYPE html>
<html>
<head>
    <title>Presentation facture</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<style>
    *{
        font-family: "Roboto", sans-serif;
    }
    header table tr td {
        padding-right: 30px;
    }

    header table .for-logo img {
        width: 100px;
    }

    header table .for-name {
        text-align: center;
    }

    header table .for-name p {
        font-size: 12px;
    }

    header table .for-name h3 {
        font-family: "Arial Black";
        color: #0c85d0;
    }

    .forhead {
        display: flex;
        justify-content: center;
        height: 100px;
        margin-top: 0;
        /*padding-top: 10px;*/
        /*background: #EEEEEE;*/
    }

    /*.for-logo {*/
    /*    min-width: 200px;*/
    /*    max-width: 250px;*/
    /*}*/

    .logo {
        width: 160px;
    }

    .for-factname {
        text-align: center;
        width: 206px;
        display: flex;
        justify-content: center;
        margin-top: 70px;
    }

    .for-infomation {
        font-size: 16px;
        color: #707070;
        /*border: #707070 3px dashed;*/
        height: 90px;
        padding: 10px;
        width: 530px;
    }

    .fact-title {
        margin: 0 0 0 0;
        text-align: center;
    }


    table {
        min-width: 1030px;
        border-collapse: collapse;
    }
    .for-product{
        margin-top: 30px;
    }
    .for-product > .product-table > table > thead > tr > th {
        border: 1px solid #000000;
    }

    .for-product > .product-table > table > tbody > tr > td {
        border: 1px solid #000000;
        /*padding-left: 10px;*/
        /*padding-top: 5px;*/
        padding: 5px;
    }

    .for-paiement > .paiement-table > table > thead > tr > th {
        border: 2px solid #EEEEEE;
        padding-left: 10px;
    }

    .for-paiement > .paiement-table > table > tbody > tr > td {
        border: 2px solid #EEEEEE;
        padding-left: 10px;
        padding-top: 5px;
    }


    .resume-info > td {
        padding-top: 20px;
    }
    .end{
        text-align: right;
    }
    .center{
        text-align: center;
    }
    .bold{
        font-weight: 700;
    }

    footer {
        position: fixed;
        bottom: -70px;
        left: 0px;
        right: 0px;
        height: 120px;
        text-align: center;
        line-height: 1;
        font-size: 12px;
    }

    footer table {
        width: 100%;
    }

    footer table tr td {
        width: 33%;
    }

    footer table tr div {
        width: 165px;
        background-color: #0c85d0;
        padding: 10px;
        border-radius: 10px;
        color: #ffffff;
        font-size: 9px;
    }
</style>
<body>
<div class="forhead">
    <header class="forhead">
        <table class="heading-table">
            <tr>
                <td class="for-logo">
                    @php
                        $ImagePath = $_SERVER["DOCUMENT_ROOT"] . '/images/logo/logo_gssc.png';
                    @endphp

                    {{--                    <img src="{{ asset('images/logo/logo_gssc.png') }}" class="logo" alt="Logo not found">--}}
                    <img src="{{ $ImagePath }}" class="logo" alt="Logo not found">
                </td>
                <td class="for-name">
                    <h3>{{ 'GLOBAL SOFT & COMMUNICATION Sarl' }}</h3>
                    <p>
                        <strong>GSC:</strong> Akwa rue Castelneau face direction commerciale MTN derri??re Akwa Palace, DOUALA CAMEROUN <br>
                    </p>

                </td>
                <td class="for-date">
                    <strong>{{ (new DateTime($data[0]->date_devis))->format('d').' '.$mois.' '.(new DateTime($data[0]->date_devis))->format('Y') }}</strong>
                </td>
            </tr>
        </table>
    </header>
</div>
<h3 style="text-align: center; margin: 20px;text-transform: capitalize">{{ $titre }}</h3>
<label><i>P??riode:</i> <strong>{{ $debut }}</strong> au <strong>{{ $fin }}</strong></label><br>
<label><i>Par: </i>
    <strong>{{ \Illuminate\Support\Facades\Auth::user()->lastname }} {{ \Illuminate\Support\Facades\Auth::user()->firstname }}</strong>
    {{--    <strong><?= date('d F, Y');?></strong></label>--}}
    <div class="for-product">
        <div class="product-table">
            <table>
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Reference</th>
                    <th>NB.Pro</th>
                    <th>M.HT</th>
                    <th>M.TVA</th>
                    <th>M.TTC</th>
                    <th>Par</th>
                </tr>

                </thead>
                <tbody>
                @php
                    $total=0;
                @endphp
                @foreach($data as $key=>$value)
                    @if ((new \App\Models\Factures())->montantTotal($value->facture_id)-(new \App\Models\Factures())->Payer($value->facture_id)==0)
                        <tr>
                            <td class="bold">{{ $value->date_fact}}</td>
                            <td class="" style="text-transform: uppercase">
                                @foreach($clients as $cl)
                                    @if ($cl->client_id==$value->idclient)
                                        {{ $cl->nom_client }} {{ $cl->prenom_client }} {{ $cl->raison_s_client }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="enter bold">{{ $value->reference_fact }}</td>
                            <td class="center bold">{{ count((new \App\Models\Factures())->produitFacture($value->facture_id)) }}</td>
                            <td class="end bold">{{ (new \App\Models\Factures())->montantHT($value->facture_id) }}</td>
                            <td class="end bold">{{ (new \App\Models\Factures())->montantTotal($value->facture_id) - (new \App\Models\Factures())->montantHT($value->facture_id) }}</td>
                            <td class="end bold">{{ (new \App\Models\Factures())->montantTotal($value->facture_id) }}</td>
                            <td class="end bold">
                                @foreach($users as $cl)
                                    @if ($cl->id==$value->iduser)
                                        {{ $cl->firstname }} {{ $cl->lastname }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endif

                @endforeach

                </tbody>
            </table>
        </div>
{{--        <h2>Total: {{ $total }} FCFA</h2>--}}
    </div>

    <footer class="for-footer">
        <table class="table-footer">
            <tr>
                <td>
                    <div>
                        <strong>Douala</strong>-
                        AKWA rue Castelneau face direction commerciale MTN derri??re Akwa Palace,  DOUALA CAMEROUN<br>
                        gscdla@gsc-technology.com
                    </div>
                </td>
                <td>
                    <div>
                        <strong>Yaounde</strong>, Rond pointNlongkak immeuble Pharmacie Lumiere
                        <br>
                        gscyde@gsc-technology.com
                    </div>
                </td>
                <td>
                    <div>
                        <strong>Garoua</strong>, centre Commercial face Direction PMUC<br>
                        gscgaroua@gsc-technology.com
                    </div>
                </td>
                <td>
                    <div>
                        <strong>Ndjamena, Tchad</strong> - avenue Ngarterie Mathias axe<br>
                        gsctchad@gsc-technology.com
                    </div>
                </td>
            </tr>
        </table>
    </footer>
</body>
</html>
