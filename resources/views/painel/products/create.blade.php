@extends('layouts.app')
@section('content')
<div class="page-header d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <div class="page-pretitle">
                Adicionar
            </div>
            <h2 class="page-title">
                Página de produtos
            </h2>
        </div>
    </div>
</div>
<div class="row row-cards">
    <div class="col-12">
        {!! Form::open(['route' => 'painel.products.store', 'class'=>"card", "files"=>true]) !!}
        @include('painel.products.form')
        <div class="card-footer text-end">
            <div class="d-flex">
                <a href="{{ route('painel.products.index') }}" class="btn btn-link load-onlick">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto"><svg xmlns="http://www.w3.org/2000/svg"
                        class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l5 5l10 -10" /></svg> Salvar</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection