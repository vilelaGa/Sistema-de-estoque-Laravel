<!DOCTYPE html>
<html lang="pt-br">

@include('includes.head')

<body style="background:#191919;">


    @include('includes.nav')



    <main class="container mt-5">

        <div class="color-main p-5 rounded">
            <h4 class="text-white">Monte seu relatório</b></h4>
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

            <form action="{{ route('admin-relatorio-pdf') }}" method="POST" target="_blank">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <label class="text-light">Data inicial</label>
                        <input class="form-control" type="date" name="dataIni">
                    </div>
                    <div class="col-md-4">
                        <label class="text-light">Data final</label>
                        <input class="form-control" type="date" name="dataFim">
                    </div>
                    <div class="col-md-4">
                        <label class="text-light">Tipo</label>
                        <select class="form-control" name="tipo">
                            <option value="REMOCAO">REMOÇÃO</option>
                            <option value="INSERCAO">INSERÇÃO</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-zamix mt-3">Ver relatório</button>
                <a href="{{ route('admin-home') }}" class="btn btn-outline-danger mt-3">Voltar</a>
            </form>

        </div>

    </main>



</body>

</html>
