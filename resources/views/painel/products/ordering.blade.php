@extends('layouts.app')
@section('content')
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Ordenação de Páginas
                </h2>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="divide-y-4 sort">
                        @foreach ($products as $key => $product)
                            <div data-id="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-auto align-self-center">
                                        <span class="handle">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="16 4 20 4 20 8" /><line x1="14" y1="10" x2="20" y2="4" /><polyline points="8 20 4 20 4 16" /><line x1="4" y1="20" x2="10" y2="14" /><polyline points="16 20 20 20 20 16" /><line x1="14" y1="14" x2="20" y2="20" /><polyline points="8 4 4 4 4 8" /><line x1="4" y1="4" x2="10" y2="10" /></svg>
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <span class="avatar"
                                            style="background-image: url({{ asset("storage/$product->image") }})"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                            {{ $product->reference }} - {{ $product->name }}
                                        </div>
                                        <div class="text-muted">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
                                    </div>
                                    <div class="col-auto align-self-center text-muted">
                                        em: <small>{{$product->category->name ?? 'sem categoria'}}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(function() {
            function updateToDatabase(idString) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: "{{ route('painel.products.ordering.post') }}",
                    method: 'POST',
                    data: {
                        ids: idString
                    },
                    success: function(data) {
                        $.toast(data.msg)
                    }
                })
            }
            var target = $('.sort');
            target.sortable({
                handle: '.handle',
                placeholder: 'highlight',
                update: function(e, ui) {
                    var sortData = target.sortable('toArray', {
                        attribute: 'data-id'
                    });
                    updateToDatabase(sortData.join(','));
                }
            })
        })
    </script>
@endpush
