<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>MCM Rodas</title>
  <link href="{!! mix('/css/app.css') !!}" rel="stylesheet" />
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
  <div class="flex-fill d-flex flex-column justify-content-center py-4">
    <div class="container-tight py-6">
      <div class="text-center mb-4">
        <a href="/"><img src="/img/logo.png" alt=""></a>
      </div>
      <form class="card card-md spinner" action="{{ route('login') }}" method="POST" autocomplete="off">
        @csrf
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Acesso ao Painel</h2>
          @if(session('error'))
          <div class="m-4">
            <div class="alert alert-warning">{{ session('error') }}</div>
          </div>
          @endif
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email">
          </div>
          <div class="mb-2">
            <label class="form-label">
              Senha
              <span class="form-label-description">
                <a href="./forgot-password.html">Esqueci minha senha</a>
              </span>
            </label>
            <div class="input-group input-group-flat">
              <input type="password" class="form-control" name="password" placeholder="Senha" autocomplete="off">
              <span class="input-group-text">
                <a href="#" class="link-secondary show-password" title="Mostrar Senha" data-bs-toggle="tooltip"><svg
                    xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <circle cx="12" cy="12" r="2" />
                    <path
                      d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                  </svg>
                </a>
              </span>
            </div>
          </div>
          <div class="mb-2">
            <label class="form-check">
              <input type="checkbox" class="form-check-input" />
              <span class="form-check-label">Lembrar acesso</span>
            </label>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Acessar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="{!! mix('/js/app.js') !!}"></script>
  <script>
    $(function(){
      $('a.show-password').click(function(){
        if('password' == $('input[name="password"]').attr('type')){
            $('input[name="password"]').prop('type', 'text');
        }else{
            $('input[name="password"]').prop('type', 'password');
        }
      });
    });
  </script>
</body>

</html>
