{{ Form::open(['url' => route('modal.product.add', $product->id), 'id'=> 'add-product']) }}
<div class="modal-body">
    <div class="text-center">
        <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart-plus -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-primary icon-lg" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <circle cx="6" cy="19" r="2" />
            <circle cx="17" cy="19" r="2" />
            <path d="M17 17h-11v-14h-2" />
            <path d="M6 5l6.005 .429m7.138 6.573l-.143 .998h-13" />
            <path d="M15 6h6m-3 -3v6" />
        </svg>
        <h3 class="text-primary">{{ $product->name }}</h3>
    </div>
</div>
<div class="modal-body">

    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Quantidade</label>
                <input type="number" class="form-control" name="quantity" min="1" placeholder="1" required>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Cor</label>
                {{ Form::select('color', $colors, null, ['class' => 'form-select', 'required'=>true]) }}
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label class="form-label">Tamanho</label>
                {{ Form::select('size', $sizes, null, ['class' => 'form-select', 'required'=>true]) }}
            </div>
        </div>
        <div class="col-lg-12">
            <div>
                <label class="form-label">Observações</label>
                <textarea class="form-control" rows="3" name="observation"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
        Cancelar
    </a>
    <button type="submit" class="btn btn-primary ms-auto">
        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Adicionar
    </a>
</div>
{!! Form::close() !!}
