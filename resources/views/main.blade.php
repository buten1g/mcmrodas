<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>MCM Rodas Esportivas (O maior site de rodas da america latina)</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS files -->
    <link href="{!! mix('/css/app.css') !!}" rel="stylesheet" />
</head>

<body class="antialiased">
    <div class="page catalog">
        <header class="navbar navbar-expand-md navbar-light fixed-top">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="/">
                        MCM RODAS
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown">
                        <a href="{{ route('cart') }}" class="nav-link d-flex lh-1 text-reset p-0">
                            <span class="avatar avatar-sm"><svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="6" cy="19" r="2" />
                                    <circle cx="17" cy="19" r="2" />
                                    <path d="M17 17h-11v-14h-2" />
                                    <path d="M6 5l14 1l-1 7h-13" />
                                </svg></span>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <div class="navbar-expand-md fixed-top menu-expanded">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <circle cx="5" cy="5" r="1" />
                                            <circle cx="12" cy="5" r="1" />
                                            <circle cx="19" cy="5" r="1" />
                                            <circle cx="5" cy="12" r="1" />
                                            <circle cx="12" cy="12" r="1" />
                                            <circle cx="19" cy="12" r="1" />
                                            <circle cx="5" cy="19" r="1" />
                                            <circle cx="12" cy="19" r="1" />
                                            <circle cx="19" cy="19" r="1" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Início
                                    </span>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="/products/15">
                                    <span class="nav-link-title">
                                        <strong>Lançamento1</strong>
                                    </span>
                                </a>
                            </li> -->
                            @foreach ($categories as $category)
                                @if ($category->name != 'Lançamento')
                                    @if ($category->children()->exists())
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#navbar-base"
                                                data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <polyline points="9 6 15 12 9 18" />
                                                    </svg>
                                                </span>
                                                <span class="nav-link-title">
                                                    {{ $category->name }}
                                                </span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <div class="dropdown-menu-columns">
                                                    <div class="dropdown-menu-column">
                                                        @foreach ($category->children as $subCategory)
                                                            <a class="dropdown-item"
                                                                href="{{ route('products', $subCategory->id) }}">
                                                                {{ $subCategory->name }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('products', $category->id) }}"
                                                role="button">
                                                <span class="nav-link-title">
                                                    {{ $category->name }}
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                @endif

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
    <script src="{!! mix('/js/app.js') !!}"></script>
    @stack('js')
</body>

</html>
