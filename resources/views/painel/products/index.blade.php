@extends('layouts.app')
@section('content')
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Páginas de Produtos
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('painel.products.ordering') }}"
                        class="btn btn-secondary d-none d-sm-inline-block load-onlick">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="16 4 20 4 20 8" /><line x1="14" y1="10" x2="20" y2="4" /><polyline points="8 20 4 20 4 16" /><line x1="4" y1="20" x2="10" y2="14" /><polyline points="16 20 20 20 20 16" /><line x1="14" y1="14" x2="20" y2="20" /><polyline points="8 4 4 4 4 8" /><line x1="4" y1="4" x2="10" y2="10" /></svg>
                        Ordenar
                    </a>
                    <a href="{{ route('painel.products.create') }}"
                    class="btn btn-primary d-none d-sm-inline-block load-onlick">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Adicionar
                </a>
                    <a href="{{ route('painel.products.create') }}" class="btn btn-primary d-sm-none btn-icon load-onlick"
                        data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cards">
        @if (!$products->isEmpty())
            @foreach ($products as $product)
                <div class="col-sm-3 col-lg-3 sort">
                    <div class="card card-sm">
                        <a href="{{ route('painel.products.edit', $product->id) }}" class="d-block"><img
                                src="{{ asset("storage/$product->image") }}" class="card-img-top"></a>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div>{{ $product->name }}</div>
                                    <div class="text-muted">{{ $product->reference }}</div>
                                </div>
                                <div class="text-center ms-auto">
                                    <div>{{ $product->price }}</div>
                                    <div><a class="remove text-muted"
                                            href="{{ route('painel.products.destroy', $product->id) }}"
                                            data-target-remove="reload" title="Remover esta página?"><svg
                                                xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <line x1="4" y1="7" x2="20" y2="7" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-warning">
                    <p>Não há registros para listar.</p>
                </div>
            </div>
        @endif
    </div>
@endsection
