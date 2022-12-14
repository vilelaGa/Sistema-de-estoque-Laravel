<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @include('includes.bootstrap')
    @include('includes.links')

    <title>Login - Admin</title>
</head>

<body class="pag">
    @include('includes.nav')

    <div class="container">
        <div class="row">

            <div class="col-md-3"></div>
            <div class="col-md-6">

                <div class="form-center">

                    <h4 class="text-light">Login</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                    @endif

                    <form action="{{ route('admin-auth') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="senha" placeholder="Senha">
                        </div>

                        <button type="submit" class="btn btn-zamix">Login</button>

                    </form>
                </div>

            </div>
            <div class="col-md-3"></div>

        </div>


    </div>
    </div>

</body>

</html>
