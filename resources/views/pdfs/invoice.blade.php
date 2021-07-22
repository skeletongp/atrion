<div class="body">
    <div class="div-title">
        <div class="logo"></div>
        <h3 class="h-title">Nombre del Negocio</h3>
        <h3 class="h-subtitle">Teléfono</h3>
        <h3 class="h-subtitle">Dirección Completa del Negocio</h3>
    </div>
    <hr>

    <div class="info">
        <div class="cliente">
            <h3 class="h-name">Facturar A:</h3>
            <h3 class="h-info">{{ $invoice->client->name }}</h3>
            <h3 class="h-info">{{ $invoice->client->phone }}</h3>
        </div>
        <div class="info-factura">
            <h3 class="h-name">Factura:</h3>
            <h3 class="h-info">No {{ $invoice->number }}</h3>
            <h3 class="h-info">{{ $invoice->date }}</h3>
        </div>
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
                    <tr style="text-align: center">
                        <td style="max-width: 18mm">{{ $detail->product->name }}</td>
                        <td style="max-width: 5mm">{{ $detail->cant }}</td>
                        <td style="max-width: 10mm">${{ $detail->price }}</td>
                        <td style="max-width: 10mm">${{ $detail->subtotal }}</td>
                    </tr>
                @endforeach
                <tr style="height: 6px">

                </tr>
               
                <tr>
                    <td style="background-color: white"></td>
                    <td colspan="2" class="td-total">Subtotal</td>
                    <td class="td-total">{{ $invoice->subtotal }}</td>
                </tr>
                <tr>
                    <td style="background-color: white"></td>
                    <td colspan="2" class="td-total">ITBIS</td>
                    <td class="td-total">{{ $invoice->tax }}</td>
                </tr>
                <tr>
                    <td style="background-color: white"></td>
                    <td colspan="2" class="td-total">Total</td>
                    <td class="td-total">{{ $invoice->total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <h3>¡GRACIAS POR PREFERIRNOS!</h3>
        <h4>**  Favor revisar su factura al momento de pagar.**</h4>
        <h4>**  No se aceptan devoluciones.**</h4>
    </div>
</div>
<style>
    * {
        font-size: 10px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
    }

    .body {
        max-width: 80mm;
        min-width: 80mm;
        min-height: 80vh;
        margin: 0 auto 0 auto;
        box-shadow: 0 3px 2px 0;
        padding: 1rem 3px 0 3px;
        position: relative;
    }

    .div-title {
        text-align: center
    }

    .logo {
        width: 20mm;
        height: 20mm;
        border-radius: 50%;
        background-color: #BC544B;
        margin: 0 auto 0 auto;
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
        border-top: #888 12px;
        margin: 10px 2px 10px 2px;
    }

    .info {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
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
        font-size: 15px;
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

    }

    .thead th {
        padding: 4px 2px 4px 2px;
        text-transform: uppercase
    }

    .tbody td {
        padding: 1px 2px 1px 2px;
    }

    .td-total {
        text-align: right;
        font-weight: bold;
        font-size: 11px;
        text-transform: uppercase;
    }
    .footer{
        position: absolute;
        bottom: 15px;
        text-align: center
        
    }
    .footer h3{
        font-size: 14px;
        text-align: center;
        width: fit-content;
        margin: 0 auto 8px auto;
        
    }
    .footer h4{
        font-size: 11px;
        text-align: center;
        width: 70%;
        margin: 0 auto 0 auto;
        word-wrap: break-word;
    }

</style>
