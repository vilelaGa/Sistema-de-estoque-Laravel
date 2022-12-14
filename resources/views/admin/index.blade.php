<!DOCTYPE html>
<html lang="pt-br">

@include('includes.head')

<body style="background:#191919;">


    @include('includes.nav')


    <main class="container mt-5">
        <div class="color-main p-5 rounded">
            <h1 class="text-light">Bem vindo! <b>{{ @Auth::user()->name }}</b></h1>
            <p class="lead text-light">Este e o painel do estoque.</p>
            <a class="btn btn-lg btn-zamix" href="{{ route('admin-registrar') }}" role="button">Registrar usuários
                &raquo;</a>
            <a class="btn btn-lg btn-outline-primary" href="{{ route('admin-produto-simples') }}" role="button">Produto
                simples
                &raquo;</a>
            <a class="btn btn-lg btn-outline-primary" href="" role="button">Produto compostos
                &raquo;</a>
            <a class="btn btn-lg btn-outline-primary" href="{{ route('admin-requisicao') }}" role="button">Criar
                requisições
                &raquo;</a>
            <a class="btn btn-lg btn-outline-primary" href="{{ route('admin-relatorios') }}" role="button">Relatórios
                &raquo;</a>
            <a class="btn btn-lg btn-outline-danger" href="{{ route('admin-logout') }}">Deslogar &raquo;</a>
        </div>

        <h4 class="mt-5 text-light">Requisições:</h4>

        <p class="text-white">{{ count($requisicoes) }}
            <?= count($requisicoes) > 1 ? 'resultados disponiveis' : 'resultado disponivel' ?>
        </p>
        <hr>
        @foreach ($requisicoes as $linha)
            <div class="card text-center mb-3">
                <div class="card-header">
                    @if ($linha->tipo == 'INSERCAO')
                        INSERÇÃO
                    @elseif($linha->tipo == 'REMOCAO')
                        REMOÇÃO
                    @endif
                </div>
                <div class="card-body">
                    <p class="card-text"><?= str_replace(',', '<br>', $linha->listagem_produtos) ?></p>
                    <hr>
                    <form action="{{ route('admin-requisicao-update', ['id' => $linha->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-outline-success">Cumprido</button>
                    </form>
                </div>
                <div class="card-footer text-white">
                    <p>Prazo até:
                        <?= str_replace('-', '/', $linha->data_prazo) ?> - Criado por
                        <b>{{ $linha->nome_criador }}</b>
                    </p>
                </div>
            </div>
        @endforeach
    </main>



</body>

</html>
