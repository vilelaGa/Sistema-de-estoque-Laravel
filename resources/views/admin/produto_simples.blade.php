<!DOCTYPE html>
<html lang="pt-br">

@include('includes.head')

<body style="background:#191919;">


    @include('includes.nav')



    <main class="container mt-5">

        <div class="color-main p-5 rounded">
            <h4 class="text-white">Cadastrar produto simples</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin-produto-simples-store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-3"><input class="form-control mb-2" type="text" name="nome"
                            placeholder="Nome">
                    </div>
                    <div class="col-md-3"><input class="form-control mb-2" type="text" id="preco_custo"
                            name="preco_custo" placeholder="Preço de custo (R$)">
                    </div>
                    <div class="col-md-3"><input class="form-control mb-2" type="text" id="preco_venda"
                            name="preco_venda" placeholder="Preço de venda (R$)">
                    </div>
                    <div class="col-md-3"><input class="form-control mb-2" type="number" name="num_unidades"
                            placeholder="Número de unidades">
                    </div>
                </div>

                <button type="submit" class="btn btn-zamix mt-3">Adicionar</button>
                <a href="{{ route('admin-home') }}" class="btn btn-outline-danger mt-3">Voltar</a>
            </form>

        </div>

        <h4 class="text-white mt-5">Protudos simples</h4>

        <hr>
        <div class="container">

            <div class="row">
                @foreach ($produtos as $linha)
                    <div class="col-md-3">
                        <div class="card mt-4">
                            <div class="card-header">
                                {{ $linha->nome }}<br>
                                @if ($linha->status == 'EMestoque')
                                    <span class="text-success">Em estoque</span>
                                @elseif($linha->status == 'EMfalta')
                                    <span class="text-danger">Em falta</span>
                                @endif
                            </div>
                            <div class="card-body">
                                {{-- <h5 class="card-title">Special title treatment</h5> --}}
                                <p class="card-text">Preço Custo:
                                    <b><?= 'R$ ' . number_format($linha->preco_custo, 2, ',', '.') ?></b>
                                </p>

                                <p class="card-text">Preço Venda:
                                    <b><?= 'R$ ' . number_format($linha->preco_venda, 2, ',', '.') ?></b>
                                </p>

                                <p class="card-text">Total unidades: {{ $linha->num_unidades }}
                                </p>
                                <form action="{{ route('admin-produto-simples-update', ['id' => $linha->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-zamix">Retirar tudo do estoque</button>
                                </form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('admin-produto-simples-att', ['id' => $linha->id]) }}"
                                            class="btn btn-outline-success mt-2">Atualizar</a>
                                    </div>

                                    <div class="col-md-6">
                                        <form action="{{ route('admin-produto-simples-delete', ['id' => $linha->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger mt-2">Excluir</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
