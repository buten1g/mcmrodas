@extends('main')
@section('content')
    <div class="content"  style="padding-top:100px">
        <div class="container" id="cart-content">
            <div class="success"></div>
            @if (!$items->isEmpty())
                <div class="row" id="cart-row">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Ref.</th>
                                            <th>Tam.</th>
                                            <th>Cor</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)

                                            <tr style="border: #FFF">
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->options->size }}</td>
                                                <td>{{ $item->options->color }}</td>
                                                <td>
                                                    <a href="{{ route('product.remove', $item->rowId) }}"
                                                        class="remove"><svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <line x1="4" y1="7" x2="20" y2="7" />
                                                            <line x1="10" y1="11" x2="10" y2="17" />
                                                            <line x1="14" y1="11" x2="14" y2="17" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-muted">
                                                    @if ($item->options->observation)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M3 6h2.397a5 5 0 0 1 4.096 2.133l4.014 5.734a5 5 0 0 0 4.096 2.133h3.397" />
                                                            <path d="M18 19l3 -3l-3 -3" />
                                                        </svg>
                                                        {{ $item->options->observation }}
                                                    @endif
                                                </td>
                                                <td colspan="2" class="text-end">
                                                    <small>R$ {{ $item->price('2', ',', '.') }} x
                                                        {{ $item->qty }}:</small>
                                                    <div><strong>R$ {{ $item->subtotal('2', ',', '.') }}</strong></div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {!! Form::open(['url' => route('pdf-generate'), 'id' => 'cart ', 'method'=>'post']) !!}
                    {!! Form::hidden('discount', 0) !!}
                    <div class="col-12 mt-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" name="fullName" placeholder="Nome e Sobrenome">
                    </div>
                    <div class="col-12 mt-3">
                        <table class="table table-transparent table-responsive">
                            <tbody>
                                <tr>
                                    <td colspan="4" class="strong text-end">Itens</td>
                                    <td class="text-end font-weight-bold">{{ $count }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="font-weight-bold text-uppercase text-end">Subtotal</td>
                                    <td class="font-weight-bold text-end">R$ {{ $total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="font-weight-bold text-uppercase text-end">Valor Total</td>
                                    <td class="font-weight-bold text-end" id="total">R$ {{ $total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-pill w-100 load-onlick">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg> Baixar Pedido
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-warning">
                            <p>N??o h?? produtos em seu carrinho.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script>
        const dataItens = [];
        const labels = [];
        const contCategoria = 0;
        const arrItens = [        
            @foreach ($items as $item)
            {
                label:'{{$item->options->size}}',
                value: {{$item->qty}}
            },
            @endforeach
        ];

        arrItens.forEach(item => {
            labels.push(item.label)
            dataItens.push(item.value)
        })

        const data = {
            labels: labels,
            datasets: [{
                label: 'Gr??fico dos tamanhos de rodas do carrinho',
                data: dataItens,
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(102, 100, 90)'
                ],
                hoverOffset: 4,
                offset: 10,
                radius: '50%'
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {}
        };
    </script>
    <script>
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <script type="text/javascript">
        $(function() {
            $('.percent').mask('00,00', {
                reverse: true
            });
            $(".percent").focusout(function() {
                if ($(this).val().length <= 2) {
                    temp = $(this).val()
                    var newNum = temp + ",00"
                    $(this).val(newNum)
                }
            });
            $("input[name='inputDiscount']").on('keyup', function(e) {
                var total = parseFloat('"{{ $totalToCalc }}"'.replace(/[^\d.,]/g, "").replace('.', '')
                    .replace(',', '.'));
                var discount = parseFloat($(this).val().replace(/[^\d.,]/g, "").replace('.', '').replace(
                    ',', '.'));
                $("input[name='discount']").val(discount);
                if (discount < total) {
                    var _t = (total - (total * discount/100)).toLocaleString('pt-br', {
                        style: 'currency',
                        currency: 'BRL'
                    });
                    $("#total").html(_t);
                } else {
                    $("#total").html(total.toLocaleString('pt-br', {
                        style: 'currency',
                        currency: 'BRL'
                    }));
                }
            });
            $(document).on('click', 'a.remove', function(e) {
                e.preventDefault();
                var _this = $(this);
                Swal.fire({
                    title: 'Aten????o!',
                    text: 'Remover esse item do carrinho?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#206bc4',
                    cancelButtonColor: '#656d77',
                    confirmButtonText: 'Sim'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: _this.attr('href'),
                            data: {
                                '_token': $('meta[name=csrf-token]').attr("content")
                            }
                        }).done(function(data) {
                            location.reload();
                        }).fail(function(data) {
                            $.toast({
                                heading: 'Erro!',
                                text: 'Contate o Administrador.',
                                icon: 'error'
                            });
                        });
                    }
                })
            });
            $(document).on('click', 'button', function(data){
                $("#cart-content .success").html('<div class="row"><div class="col-12"><div class="alert alert-success"><p>Pedido processado. O Arquivo gerado pode ser compartilhado com a MCM Rodas</p></div></div></div>');
                $("#cart-row").hide();
                return true;
            });
        });
    </script>
@endpush
