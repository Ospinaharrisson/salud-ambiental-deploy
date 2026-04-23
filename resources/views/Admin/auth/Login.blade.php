<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Login</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/admin/login/login-style.css')}}" />

      <style>
        .login-background:before {
          background-image: url('{{ asset('assets/images/admin/login/background.jpg') }}');
        }
      </style>
  </head>

  <body class="text-center login-background">
    <main class="form-signin no-zindex">

      <form action="{{ route('authenticate') }}" method="post">
        {{ csrf_field() }}

        <span class="login-card">
            <h1 class="h3 mb-3 fw-normal text-white border-bottom pb-3">Iniciar sesión</h1>
            <img class="mb-4" src="{{asset('assets/images/shared/env-health-logo.png')}}" alt="logo" width="290">
        </span>
    
        <div class="form-floating">
          <input type="email" name="email" class="form-control"  placeholder="Correo">
          <label for="floatingInput">Correo</label>
        </div>

        <div class="form-floating">
          <input type="password" name="password" class="form-control" placeholder="Contraseña">
          <label for="floatingPassword">Contraseña</label>
        </div>

        <button class="w-100 btn btn-lg btn-brand" type="submit">Iniciar</button>

        @if ($errors->has('login'))
          <div class="alert alert-danger mt-3">
              {{ $errors->first('login') }}
          </div>
        @endif

        <p class="mt-5 mb-3 text-muted">© Portal Salud Ambiental</p>
      </form>
    </main>
  </body>
</html>