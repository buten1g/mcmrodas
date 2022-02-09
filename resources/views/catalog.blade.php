@extends('main')
@section('content')
    <div class="content">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ asset("storage/$product->image") }}" class="card-img-top mx-auto d-block">
                            @if ($product->category()->exists())
                                <div class="card-body text-center">
                                    <a href="#" class="btn btn-light btn-pill w-auto product-description"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="Ref: {{ $product->reference }}" data-bs-toggle="modal"
                                        data-bs-target="#product-modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <circle cx="6" cy="19" r="2" />
                                            <circle cx="17" cy="19" r="2" />
                                            <path d="M17 17h-11v-14h-2" />
                                            <path d="M6 5l6.005 .429m7.138 6.573l-.143 .998h-13" />
                                            <path d="M15 6h6m-3 -3v6" />
                                        </svg>
                                        {{ $product->priceFormated }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="product-modal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p>Carregando, aguarde...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(function() {
            $('a.product-description').on('click', function(event) {
                event.preventDefault();
                var productId = $(this).data('product-id');
                var productName = $(this).data('product-name');
                //
                $("#product-modal .modal-title").text(productName);
                $('#product-modal .content').html(
                    '<div class="row"><div class="col-12 text-center"><p>Carregando, aguarde...</p></div></div>'
                );
                //
                $('#product-modal').modal('show');
                $.get("/modal/product/" + productId, function(data) {
                    $("#product-modal .content").html(data)
                });
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on("submit", "form#add-product", function(event) {
                event.preventDefault();
                _url = $(this).attr('action');
                _data = $(this).serialize();
                $.ajax({
                    type: "POST",
                    data: _data,
                    url: _url,
                    success: function(data) {
                        $('#product-modal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Produto adicionado ao carrinho!',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                });
            });
        });

    </script>
@endpush
