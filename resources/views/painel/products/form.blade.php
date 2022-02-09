<div class="card-body">
    <div class="row">
        <div class="col-xl-4">
            <div class="row">
                <div class="col-md-6 col-xl-12">
                    <div class="mb-3">
                        {{ Form::label('name', 'Nome') }}
                        {{ Form::text('name', null, ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-12">
                    <div class="mb-3">
                        {{ Form::label('reference', 'Referência') }}
                        {{ Form::text('reference', null, ['class' => $errors->has('reference') ? 'form-control is-invalid' : 'form-control']) }}
                        @error('reference')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-12">
                    <div class="mb-3">
                        {{ Form::label('price', 'Valor') }}
                        <div class="input-group">
                            <span class="input-group-text">
                                R$
                            </span>
                            {{ Form::text('price', null, ['class' => $errors->has('price') ? 'form-control is-invalid money' : 'form-control money']) }}
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-12">
                    <div class="mb-3">
                        {{ Form::label('category_id', 'Categoria') }}
                        {!! Form::select('category_id', $categories, null, ['class' => $errors->has('category_id') ?
                        'form-select is-invalid' : 'form-select']) !!}
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-12">
                    <div class="mb-3">
                        {{ Form::label('observation', 'Observação') }}
                        {{ Form::textarea('observation', null, ['class' => $errors->has('observation') ? 'form-control is-invalid' : 'form-control']) }}
                        @error('observation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="row">
                <div class="form-group">
                    {!! Form::label('image', 'Imagem', array('class' => 'col-sm-12')) !!}
                    <div class="col-sm-12">
                        {!! Form::file('image', ['class' => 'dropify', 'data-height'=>'500']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="row">
                {{ Form::label('Tamanhos', 'Tamanhos') }}
                @foreach ($sizes as $key=>$size)
                <div class="col-md-6 col-xl-6">
                    <label class="form-check form-switch">
                        {{ Form::checkbox('sizes[]', $key, null, ['class'=>'form-check-input']) }}
                        <span class="form-check-label">{{ $size }}</span>
                    </label>
                </div>
                @endforeach
                <div class="mb-3">
                    @error('sizes')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                {{ Form::label('cores', 'Cores') }}
                @foreach ($colors as $key=>$color)
                <div class="col-md-6 col-xl-6">
                    <label class="form-check form-switch">
                        {{ Form::checkbox('colors[]', $key, null, ['class'=>'form-check-input']) }}
                        <span class="form-check-label">{{ $color }}</span>
                    </label>
                </div>
                @endforeach
                <div class="mb-3">
                    @error('colors')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script type="text/javascript">
    $(function(){
        $('.dropify').dropify({
        messages: {
            default: 'Imagem',
            replace: 'Substituir imagem',
            remove: 'Remover',
            error: 'Desculpe, o arquivo é muito grande'
        },
        defaultFile: '{{ isset($product) && $product->image ? asset("storage/$product->image") : ''}}'
        });
        //
        $('.money').mask('000.000.000.000.000,00', {reverse: true});
        $(".money").focusout(function(){
            if($(this).val().length <= 2){
                temp = $(this).val()
                var newNum = temp + ",00"
                $(this).val(newNum)
            }
        })
    });
</script>
@endpush