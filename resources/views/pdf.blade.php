<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MCM Rodas - Ordem de compra PDF</title>
</head>

<body>
    <table align="center">
        <tr>
            <td style="padding:40px 0"> <img src="https://www.gran-turismo.com/gtsport/decal/4764909567290115096_1.png" alt="MCM Rodas"></td>
        </tr>
    </table>
    <hr>
    <table style="width: 100%">
        <tbody>
            <tr>
                <td>Nome: <strong>{{ $fullName }}</strong></td>
            </tr>
            <tr>
                <td>Data do pedido: <strong>{{ $data }}</strong></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table style="width:100%">
        <thead>
            <tr style="border: 1px solid #ccc">
                <th style="border: 1px solid #ccc">Ref.</th>
                <th style="border: 1px solid #ccc">Tam.</th>
                <th style="border: 1px solid #ccc">Cor</th>
                <th style="border: 1px solid #ccc">Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr style="border: #FFF; ">
                    <td style="width: 20%; text-align:center; border: 1px solid #ccc">{{ $item->name }}</td>
                    <td style="width: 20%; text-align:center; border: 1px solid #ccc">{{ $item->options->size }}</td>
                    <td style="width: 20%; text-align:center; border: 1px solid #ccc">{{ $item->options->color }}</td>
                    <td style="width: 40%; text-align:center; border: 1px solid #ccc">
                        <small>R$ {{ $item->price('2', ',', '.') }} x {{ $item->qty }}:</small>
                        <strong>R$ {{ number_format(($item->price * $item->qty), 2) }}</strong>
                    </td>
                </tr>
                @if ($item->options->observation)
                <tr>
                    <td colspan="3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 6h2.397a5 5 0 0 1 4.096 2.133l4.014 5.734a5 5 0 0 0 4.096 2.133h3.397" />
                            <path d="M18 19l3 -3l-3 -3" />
                        </svg>
                        {{ $item->options->observation }}
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <hr>
    <table style="width: 100%">
        <tbody>
            <tr>
                <td style="text-align:right">Itens: <strong>{{ $count }}</strong></td>
            </tr>
            <tr>
                <td style="text-align:right">Subtotal: <strong>R$ {{ $subTotal }}</strong></td>
            </tr>
            <tr>
                <td style="text-align:right">Valor Total <strong>R$ {{ $total }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
