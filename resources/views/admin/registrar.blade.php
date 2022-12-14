<!DOCTYPE html>
<html lang="pt-br">

@include('includes.head')

<body class="pag-registra">


    @include('includes.nav')


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">


                <div class="form-center ">
                    <h4 class="text-light">Registrar usuários</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin-store') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <input type="text" name="nome" class="form-control" placeholder="Nome">

                        </div>

                        <div class="mb-3">

                            <input type="email" name="email" class="form-control" placeholder="Email">

                        </div>

                        <div class="mb-3">

                            <input type="password" name="senha" class="form-control" placeholder="Senha">
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
