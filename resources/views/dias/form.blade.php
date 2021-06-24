
<div class="card-body">
    <h4 class="card-title">Información Día Especial</h4>
    @csrf  
    <div class="form-group row">
        <div class="col-sm-3">
            <div class="b-label">
                <label for="name" class="control-label col-form-label">Descripción</label>
            </div>
        </div>
        <div class="col-sm-5">
            <textarea rows="1" class="form-control {{ $errors->has('descripcion') ? ' is-invalid' : '' }}" id="descripcion" name="descripcion">{{ old('descripcion', $dia->descripcion)  }}</textarea>
            @if ($errors->has('descripcion'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('descripcion') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            <div class="b-label">
                <label for="name" class="control-label col-form-label">Fecha</label>
            </div>
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control {{ $errors->has('fecha') ? ' is-invalid' : '' }} " id="fecha"  name="fecha" value="{{old('fecha', $dia->fecha)  }}">
            @if ($errors->has('fecha'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('fecha') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<hr>
@push('scripts')
<script>
    $('#fecha').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy',
        locale: 'es-es',
    });
</script>
@endpush