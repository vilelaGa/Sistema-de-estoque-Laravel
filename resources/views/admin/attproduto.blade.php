<!DOCTYPE html>
<html lang="pt-br">

@include('includes.head')

<body style="background:#191919;">


    @include('includes.nav')



    <main class="container mt-5">

        <div class="color-main p-5 rounded">
            <h4 class="text-white">Atualizar o produto: <b>{{ $produtos->nome }}</b></h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin-produto-simples-update-dados', ['id' => $produtos->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-3"><input class="form-control" type="text" name="nome" placeholder="Nome">
                    </div>
                    <div class="col-md-3"><input class="form-control" type="text" id="preco_custo" name="preco_custo"
                            placeholder="Preço de custo (R$)">
                    </div>
                    <div class="col-md-3"><input class="form-control" type="text" id="preco_venda" name="preco_venda"
                            placeholder="Preço de venda (R$)">
                    </div>
                    <div class="col-md-3"><input class="form-control" type="number" name="num_unidades"
                            placeholder="Número de unidades">
                    </div>
                </div>

                <button type="submit" class="btn btn-zamix mt-3">Adicionar</button>
                <a href="{{ route('admin-home') }}" class="btn btn-outline-danger mt-3">Voltar</a>
            </form>

        </div>

    </main>


    <script>
        $(function() {
            $('#preco_custo').maskMoney();
            $('#preco_venda').maskMoney();
        })
    </script>


</body>

</html>
