@extends('layouts.app')
@section('content')
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
                Categorias de produtos
            </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="{{ route('painel.categories.create') }}"
                    class="btn btn-primary d-none d-sm-inline-block load-onlick">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Adicionar
                </a>
                <a href="{{ route('painel.categories.create') }}" class="btn btn-primary d-sm-none btn-icon load-onlick"
                    data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" /></svg>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row row-cards">
    <div class="col-12">
        @if (!$categories->isEmpty())
        <div class="card">
            <div class="table-responsive mb-0">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Observação</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $cat)
                        <tr>
                            <td>{{ str_repeat(' - ', $cat->depth) }} <a
                                    href="{{ route('painel.categories.edit', $cat->id) }}"
                                    class="load-onlick">{{ $cat->name }}</a></td>
                            <td class="text-muted">
                                {{ $cat->observation }}
                            </td>
                            <td>
                                <a class="remove text-muted" href="{{ route('painel.categories.destroy', $cat->id) }}"
                                    data-target-remove="{{ $cat->descendants()->count() ? 'reload' : 'tr' }}"
                                    title="Remover a categoria?"><svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="4" y1="7" x2="20" y2="7" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="alert alert-warning">
            <p>Não há registros para listar.</p>
        </div>
        @endif
    </div>
</div>
@endsection