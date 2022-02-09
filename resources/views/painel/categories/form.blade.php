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
                        {{ Form::label('parent_id', 'Categoria Pai') }}
                        {!! Form::select('parent_id', $categories, null, ['class' => $errors->has('parent_id') ? 'form-select is-invalid' : 'form-select']) !!}
                        @error('parent_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-12">
                    <div class="mb-3">
                        {{ Form::label('observation', 'Observação') }}
                        {{ Form::text('observation', null, ['class' => $errors->has('observation') ? 'form-control is-invalid' : 'form-control']) }}
                        @error('observation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>