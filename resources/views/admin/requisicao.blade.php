<!DOCTYPE html>
<html lang="pt-br">

@include('includes.head')

<body class="pag-request">


    @include('includes.nav')


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">


                <div class="form-center">
                    <h4 class="text-light">Criar requisição</h4>
                    <hr>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin-requisicao-store') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <input type="hidden" name="criador" value="{{ @Auth::user()->name }}">

                            <label class="text-light">Data de cumprimento</label>
                            <input type="date" name="data" class="form-control">

                        </div>

                        <div class="mb-3">
                            <label class="text-light">Lista de produtos e quantidade (Ao final da linha coloque virgula
                                <b>","</b>)</label>
                            <textarea name="lista" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="text-light">Tipo</label>
                            <select class="form-control" name="tipo">
                                <option value="REMOCAO">REMOÇÃO</option>
                                <option value="INSERCAO">INSERÇÃO</option>
                            </select>
                        </div>


                        <button type="submit" class="btn btn-zamix">Criar</button>
                        <a href="{{ route('admin-home') }}" class="btn btn-danger">Voltar</a>
                    </form>

                </div>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>




</body>

</html>
