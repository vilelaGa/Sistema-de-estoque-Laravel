<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Zamix</title>
</head>


<body>

    <style>
        h1 {
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            margin: auto;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            width: 120px;
        }

        th {
            font-weight: bold;
        }


        tr:nth-child(even) {
            background-color: #f0dcb4;
        }

        tr:hover:nth-child(1n + 2) {
            background-color: #ff8000;
            color: #fff;
        }
    </style>

    <center>
        <h2>Relatório</h2>
        <p>Data Inicial: <?= $dataI ?></p>
        <p>Data Final: <?= $dataF ?></p>
    </center>

    <table>
        <tr>
            <th>Nome</th>
            <th>Preço Custo</th>
            <th>Preço Venda</th>
            <th>Número de Unidades</th>
        </tr>

        @foreach ($produtos_get as $linha)
            <tr>
                <td>{{ $linha->nome }}</td>
                <td><?= 'R$ ' . number_format($linha->preco_custo, 2, ',', '.') ?></td>
                <td><?= 'R$ ' . number_format($linha->preco_venda, 2, ',', '.') ?></td>
                <td>{{ $linha->num_unidades }}</td>
            </tr>
        @endforeach
    </table>


    <table style="margin-top: 20px">
        <tr>
            <th>Total

                @if ($request == 'REMOCAO')
                    Removido
                @elseif($request == 'INSERCAO')
                    Inserido
                @endif
            </th>
        </tr>
        <tr>
            <td><?= $produtos_soma ?></td>
        </tr>
    </table>



</body>

</html>
