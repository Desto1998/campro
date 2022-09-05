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
        width:100%;
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
                        $ImagePath = $_SERVER["DOCUMENT_ROOT"] . '/images/logo-camrail.png';
                    @endphp

                    {{--                    <img src="{{ asset('images/logo/logo_gssc.png') }}" class="logo" alt="Logo not found">--}}
                    <img src="{{ $ImagePath }}" class="logo" alt="Logo not found">
                </td>
                <td class="for-name">
{{--                    <h3>{{ 'GLOBAL SOFT & COMMUNICATION Sarl' }}</h3>--}}
{{--                    <p>--}}
{{--                        <strong>GSC:</strong> Akwa rue Castelneau face direction commerciale MTN derrière Akwa Palace, DOUALA CAMEROUN <br>--}}
{{--                    </p>--}}

                </td>
                <td class="for-date">
                    <strong>{{ date('Y-m-d') }}</strong>
                </td>
            </tr>
        </table>
    </header>
</div>
<h3 style="text-align: center; margin: 20px;text-transform: capitalize">{{ "Liste des requètes" }}</h3>
<label><i>Période:</i> <strong>{{ $debut }}</strong> au <strong>{{ $fin }}</strong></label><br>
<label><i>Par: </i>
    <strong>{{ \Illuminate\Support\Facades\Auth::user()->lastname }} {{ \Illuminate\Support\Facades\Auth::user()->firstname }}</strong>
    {{--    <strong><?= date('d F, Y');?></strong></label>--}}
    <div class="for-product">
        <div class="product-table">
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
{{--                    <th>Action</th>--}}
                </tr>
                </thead>
                <tbody>
{{--                {{ dd($data) }}--}}
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
                                    &#8226; &nbsp; {{ $item->titre_for }}<br>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($sousdo as $item)
                                @if ($item->id_re==$value->id_re)
                                    &#8226; &nbsp; {{ $item->titre_sousdo }}<br>
                                @endif
                            @endforeach
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>


</body>
</html>
