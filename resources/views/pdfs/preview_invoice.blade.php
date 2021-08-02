<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <h3 class="h-info" style="float: right">{{ date('d M, Y', strtotime($invoice->date)) }}</h3>
</head>
<div class="body">

    <div class="div-title">
        <div class="logo"></div>
        <h3 class="h-title">{{ $company->name }}</h3>
        <h3 class="h-subtitle"><i class="icon-phone-sign"></i>
            {{ $company->phone }}</h3>
        <h3 class="h-subtitle">{{ $company->location }}</h3>
        <h3 class="h-subtitle">RNC: {{ $company->rnc }}</h3>
        <h3 class="h-subtitle">Sucursal: {{ $invoice->user->place->name }}</h3>
    </div>
    <hr>

    {{ setlocale(LC_ALL, 'es_ES.UTF-8') }}
    <div class="info">
        <table style="width: 70mm; margin: 0 auto 0 auto">
            <tr>
                <td style="width:30mm; text-align:center">
                    @if ($invoice->cash)
                    <h3 class="h-name">Facturado a:</h3>
                    @else
                    <h3 class="h-name">Cotizado a:</h3>
                    @endif
                    <h3 class="h-info">{{ $invoice->client->name }}</h3>
                    <h3 class="h-info">Tel.: {{ $invoice->client->phone }}</h3>
                    <h3 class="h-info">RNC: {{ $invoice->client->rnc }}</h3>
                </td>
                <td style="width:30mm; text-align:center; border-left: dotted 0.3px black;">
                    @if ($invoice->cash)
                    <h3 class="h-name">Factura:</h3>
                    @else
                    <h3 class="h-name">Cotización:</h3>
                    @endif
                    <h3 class="h-info">No {{ $invoice->number }}</h3>

                    @if ($invoice->fiscal)
                    <h3 class="h-info">NCF: {{ $invoice->fiscal->ncf }}</h3>
                    @else
                    <h3 class="h-info">-----</h3>
                    @endif
                    @if ($invoice->cash>0 && $invoice->other==0)
                        <h3 class="h-info">EFECTIVO</h3>
                    @else
                        @if ($invoice->cash>0 && $invoice->other>0)
                            <h3 class="h-info">MIXTO</h3>
                        @else
                            <h3 class="h-info">TARJETA</h3>
                        @endif
                    @endif

                </td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="details">
        <table class="table">
            <thead class="thead">
                <tr>
                    <th style="max-width: 20mm">Prod.</th>
                    <th style="max-width: 5mm">Cant.</th>
                    <th style="max-width: 10mm">Prec.</th>
                    <th style="max-width: 10mm">Total</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @foreach ($details as $detail)
                <tr class="trbody">
                    <td style="max-width: 18mm">{{ $detail->product->name }}</td>
                    <td style="max-width: 5mm">{{ $detail->cant }}</td>
                    <td style="max-width: 10mm">${{ $detail->price }}</td>
                    <td style="max-width: 10mm">${{ $detail->subtotal }}</td>
                </tr>
                @endforeach

                <tr style="margin-top:10rem; background-color: #fff">
                    <td colspan="4" class="td-total" style="color: #fff">
                        ------------------------------------------------------------------------------------</td>
                </tr>

                <tr>
                    <td style="background-color: white"></td>
                    <td colspan="2" class="td-total">Subtotal</td>
                    <td class="td-total" style="text-align: right; padding-right:10px">${{ $invoice->subtotal }}</td>
                </tr>
                <tr>
                    <td style="background-color: white"></td>
                    <td colspan="2" class="td-total">ITBIS</td>
                    <td class="td-total" style="text-align: right; padding-right:10px"> ${{ $invoice->tax }} <b
                            style="font-size: 12px">+</b></td>
                </tr>
                @if ($details->sum('discount') > 0)
                <tr>
                    <td style="background-color: white"></td>
                    <td colspan="2" class="td-total">Descuento </td>
                    <td class="td-total" style="text-align: right; padding-right:10p">
                        ${{ round($details->sum('discount'), 0, 2) }} <b style="font-size: 12px">-</b></td>
                </tr>

                @endif
                <tr>
                    <td style="background-color: white"></td>
                    <td colspan="2" class="td-total">Total</td>
                    <td class="td-total" style="text-align: right; padding-right:10px">${{ $invoice->total }}</td>
                </tr>

                <tr style="margin-top:10rem; background-color: #fff">
                    <td colspan="4" class="td-total" style="color: #fff">
                        ------------------------------------------------------------------------------------</td>
                </tr>

                @if ($invoice->cash)
                <tr>
                    <td style="background-color: white"></td>
                    <td colspan="2" class="td-total">Efectivo</td>
                    <td class="td-total" style="text-align: right; padding-right:10px"> ${{ $invoice->cash }}
                    </td>
                </tr>
                @endif
                @if ($invoice->other > 0){
                <tr>
                    <td style="background-color: white"></td>
                    <td colspan="2" class="td-total">Otro</td>
                    <td class="td-total" style="text-align: right; padding-right:10px"> ${{ $invoice->other }}
                    </td>
                </tr>
                }

                @endif
                @if ($invoice->cash)
                <tr>
                    <td style="background-color: white"></td>
                    <td colspan="2" class="td-total">Balance</td>
                    <td class="td-total" style="text-align: right; padding-right:10px">
                        <span style="{{ $invoice->rest > 0 ? 'color:red' : '' }}">
                            ${{ $invoice->rest }}</span>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <table class="tb_firm">
        <tbody>
            <tr>
                <td>
                    <div class="firm">
                        <h3>Cajero: </h3>
                        <span>{{ $invoice->user->name }}</span>
                    </div>
                </td>
                @if ($invoice->salor)
                <td>
                    <div class="firm">
                        <h3>Vendedor: </h3>
                        <span>{{ $invoice->salor->name }}</span>
                    </div>
                </td>
                @endif
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <h3>¡GRACIAS POR PREFERIRNOS!</h3>
        @if ($invoice->cash)
        <h4>** Favor revisar su factura al momento de pagar.**</h4>
        <h4>** No se aceptan devoluciones.**</h4>
        @else
        <h4>** Ticket para fines de estimación.**</h4>
        <h4>** Los precios pueden variar al momento de la compra.**</h4>
        @endif
    </div>
</div>
<script type="text/javascript">
    try { this.print(); } catch (e) { window.onload = window.print; } 
</script>


<style>
    * {
        font-size: 10px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif;
        transform: scale(0.99)
    }


    @page {
        size: 80mm 257mm;
        padding: 0;
        margin: 3mm 1mm 0 1mm
    }

    .body {
        max-width: 80mm;
        min-width: 80mm;
        margin: 0 auto 0 auto;
        padding: 0;
        position: relative;
    }

    .div-title {
        text-align: center
    }

    .logo {
        width: 20mm;
        height: 20mm;

        border-radius: 3.8rem 3.8rem 3.8rem 3.8rem;
        background-color: #BC544B;
        margin: 0 auto 0 auto;
        background-position: center;
        background-size: cover;
        background-image: url(<?php echo $company->logo; ?>);
    }

    .h-title {
        margin-top: 5px;
        font-size: 15px;
        text-transform: uppercase;
        font-weight: bold;
    }

    .h-subtitle {
        margin-top: 5px;
        font-size: 12px;
        text-transform: capitalize;
        font-weight: bold;
    }

    .div-title h3 {
        margin-bottom: -4px;
    }

    hr {
        border-top: #888 1px;
        margin: 10px 2px 10px 2px;
    }

    .info {

        margin: 0px 5px 0px 5px;
    }

    .info-factura {
        text-align: right;
    }

    .cliente {}

    .info div {
        height: 18mm;
        width: 46%;
        padding: 0.3rem;
    }

    .h-name {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 13px;
        margin-bottom: 4px;
        margin-top: -1px
    }

    .h-info {
        font-weight: 300;
        font-size: 13px;
        margin-bottom: -2px;
        margin-top: 1px
    }

    .details {}

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .thead th {
        padding: 4px 2px 4px 2px;
        text-transform: uppercase
    }

    .tbody td {
        padding: 1px 2px 1px 2px;
    }

    .tbody .trbody {
        border-top: rgba(200, 200, 200, 0.25) solid 0.05px;
        text-align: center;
    }

    .td-total {
        text-align: right;
        font-weight: bold;
        font-size: 11px;
        text-transform: uppercase;
    }



    .footer {
        margin-top: 20px;
        text-align: center;
        height: 7.5rem;
    }

    .footer h3 {
        font-size: 14px;
        text-align: center;
        width: fit-content;
        margin-bottom: 3px;
    }

    .footer h4 {
        font-size: 11px;
        text-align: center;
        width: 70%;
        margin: 0 auto 0 auto;
        word-wrap: break-word;
    }

    .tb_firm {
        width: 100%
    }

    .tb_firm td {
        text-align: center
    }

    .firm {
        font-size: 12px;
    }

    .firm span {
        text-transform: uppercase;
        font-size: 11px;
    }

    .firm h3 {
        margin-bottom: 5px;
    }

    .back {
        font-weight: bold;
        font-size: 1.5rem;
        cursor: pointer;
    }
</style>