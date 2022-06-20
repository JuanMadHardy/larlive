<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail de Fallo en Nodo</title>
</head>
<body>
    <h3>{{ $details['title'] }}</h3>
    <h1 style="text-decoration: underline">Datos de incidente</h1>
    <h3>{{ $details['tpv'] }}</h3>
    <h3>{{ $details['ip'] }}</h3>

    <h2>Detalle de la incidencia</h2>
    <hr style="opacity: 0.5">
    <table style="border: 1px solid gray; text-align: center; width: 100%">
        <tr>
            <th style="width: 30%; padding: 1px 10px; border: 1px solid grey; background-color: #6495ed;color: white;"><strong>Fecha/Hora</strong></th>
            <th style="width: 30%; padding: 1px 10px; border: 1px solid grey; background-color: #6495ed;color: white;"><strong>IP</strong></th>
            <th style="width: 30%; padding: 1px 10px; border: 1px solid grey; background-color: #6495ed;color: white;"><strong>Estado</strong></th>
        </tr>
            @if ( $details['actv'])
                @foreach($details['actv'] as $actv)
                    <tr style="border: 1px solid gray">
                        <td style="width: 30%; padding: 1px 10px; border: 1px solid grey">{{ $actv->created_at }}</td>
                        <td style="width: 30%; padding: 1px 10px; border: 1px solid grey">{{ $actv->ip }}</td>
                        <td style="width: 30%; padding: 1px 10px; border: 1px solid grey; @if ( $actv->ping > 0 ) color:red; @endif">@if ( $actv->ping > 0 ) DOWN @else UP @endif</td>
                    </tr>
                @endforeach
            @endif
    </table>

    <p>Cantidad de fallos detectado en el último mes:&nbsp;{{ $details['lastMonth'] }}</p>
</body>
</html>
