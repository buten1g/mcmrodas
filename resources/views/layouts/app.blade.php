<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>MCM Rodas</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- CSS files -->
  <link href="{!! mix('/css/app.css') !!}" rel="stylesheet" />
</head>

<body class="antialiased">
  <div class="page">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
      <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
          <a href=".">
            <img src="/img/logo.png" width="330" height="96" alt="MCM Rodas" class="navbar-brand-image">
          </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
          <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
              aria-label="Open user menu">
              <span class="avatar avatar-sm" style="background-image: url(/img/avatar.png)"></span>
              <div class="d-none d-xl-block ps-2">
                <div>{{ Auth::user()->name }}</div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              {{-- <a href="#" class="dropdown-item">Set status</a>
                <a href="#" class="dropdown-item">Profile & account</a>
                <a href="#" class="dropdown-item">Feedback</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">Settings</a> --}}
              <a href="{{ route('logout') }}" class="dropdown-item"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sair</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="navbar-expand-md">
      <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
          <div class="container-xl">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('painel.index') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg"
                      class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <polyline points="5 12 3 12 12 3 21 12 19 12" />
                      <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                      <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Início
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('painel.categories.index') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg"
                      class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />
                      <line x1="12" y1="12" x2="20" y2="7.5" />
                      <line x1="12" y1="12" x2="12" y2="21" />
                      <line x1="12" y1="12" x2="4" y2="7.5" />
                      <line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Categorias de Produtos
                  </span>
                </a>

              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('painel.products.index') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg"
                      class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                      <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                      <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Páginas de Produtos
                  </span>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                      stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <circle cx="9" cy="7" r="4" />
                      <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                      <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                      <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Clientes
                  </span>
                </a>
              </li> --}}
            </ul>
            <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
              {{-- <form action="." method="get">
                  <div class="input-icon">
                    <span class="input-icon-addon">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                    </span>
                    <input type="text" class="form-control" placeholder="Search…" aria-label="Search in website">
                  </div>
                </form> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-xl">
        @yield('content')
      </div>
      <footer class="footer footer-transparent d-print-none">
        <div class="container">
          <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
              <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                  Desenvolvido por Nathã Fioravanço
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="{!! mix('/js/app.js') !!}"></script>
  @stack('js')
  @if (session('success'))
    <script type="text/javascript">
        $(function(){
            $.toast("{{ session('success') }}")
        });
    </script>
  @elseif (session('error'))
    <script type="text/javascript">
        $(function(){
            $.toast("{{ session('error') }}")
        });
    </script>
  @endif
</body>
</html>
