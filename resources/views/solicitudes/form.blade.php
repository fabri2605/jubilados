<div class="card-body">
    <h4 class="card-title">Información de Solicitud</h4>
    @csrf  
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Fecha de Nacimiento</label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control {{ $errors->has('fecha_nacimiento') ? ' is-invalid' : '' }}" id="fecha_nacimiento" name="fecha_nacimiento"  value="{{ old('fecha_nacimiento', ($solicitud->fecha_nacimiento ? \Carbon\Carbon::parse($solicitud->fecha_nacimiento)->format('d/m/Y') : ''))  }}" required>
            @if ($errors->has('fecha_nacimiento'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Nombre</label>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre"  value="{{ old('nombre', $solicitud->nombre)  }}" required>
            @if ($errors->has('nombre'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('nombre') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Apellido</label>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control {{ $errors->has('apellido') ? ' is-invalid' : '' }}" id="apellido" name="apellido"  value="{{ old('apellido', $solicitud->apellido)  }}" required>
            @if ($errors->has('apellido'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('apellido') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Nro Trámite</label>
        </div>
        <div class="col-sm-3">
            <input type="number" class="form-control {{ $errors->has('nro_tramite') ? ' is-invalid' : '' }}" id="nro_tramite" name="nro_tramite"  value="{{ old('nro_tramite', $solicitud->nro_tramite)  }}" required>
            @if ($errors->has('nro_tramite'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('nro_tramite') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">CUIT</label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control {{ $errors->has('cuit') ? ' is-invalid' : '' }}" id="cuit" name="cuit"  value="{{ old('cuit', $solicitud->cuit)  }}" data-inputmask="'mask': '99-99999999-9'" required>
            @if ($errors->has('cuit'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('cuit') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Email</label>
        </div>
        <div class="col-sm-5">
            <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email"  value="{{ old('email', $solicitud->email)  }}" data-inputmask="'alias': 'email'">
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Celular</label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control {{ $errors->has('celular') ? ' is-invalid' : '' }}" id="celular" name="celular"  value="{{ old('celular', $solicitud->celular) }}" data-inputmask="'mask': '+54 999 9999999'" required>
            @if ($errors->has('celular'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('celular') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Fijo</label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control {{ $errors->has('fijo') ? ' is-invalid' : '' }}" id="fijo" name="fijo"  value="{{ old('fijo', $solicitud->fijo)  }}" data-inputmask="'mask': '+54 999 9999999'">
            @if ($errors->has('fijo'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('fijo') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Calle</label>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control {{ $errors->has('calle') ? ' is-invalid' : '' }}" id="calle" name="calle"  value="{{ old('calle', $solicitud->calle)  }}" required>
            @if ($errors->has('calle'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('calle') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Numeración</label>
        </div>
        <div class="col-sm-3">
            <input type="number" class="form-control {{ $errors->has('nro_calle') ? ' is-invalid' : '' }}" id="nro_calle" name="nro_calle"  value="{{ old('nro_calle', $solicitud->nro_calle)  }}" required>
            @if ($errors->has('nro_calle'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('nro_calle') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Piso</label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control {{ $errors->has('piso') ? ' is-invalid' : '' }}" id="piso" name="piso"  value="{{ old('piso', $solicitud->piso)  }}">
            @if ($errors->has('piso'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('piso') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Depto</label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control {{ $errors->has('depto') ? ' is-invalid' : '' }}" id="depto" name="depto"  value="{{ old('depto', $solicitud->depto)  }}">
            @if ($errors->has('depto'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('depto') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Manzana</label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control {{ $errors->has('manzana') ? ' is-invalid' : '' }}" id="manzana" name="manzana"  value="{{ old('manzana', $solicitud->manzana)  }}">
            @if ($errors->has('manzana'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('manzana') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Casa</label>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control {{ $errors->has('casa') ? ' is-invalid' : '' }}" id="casa" name="casa"  value="{{ old('casa', $solicitud->casa)  }}">
            @if ($errors->has('casa'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('casa') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Localidad</label>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control {{ $errors->has('localidad') ? ' is-invalid' : '' }}" id="localidad" name="localidad"  value="{{ old('localidad', $solicitud->localidad)  }}" required>
            @if ($errors->has('localidad'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('localidad') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Departamento</label>
        </div>
        <div class="col-sm-5">
            <select name="departamento" id="departamento" class="form-control combo" required>
                <option value="Capital">Capital</option>
                <option value="Maipu">Maipu</option>
                <option value="Las Heras">Las Heras</option>
                <option value="Godoy Cruz">Godoy Cruz</option>
                <option value="Guaymallen">Guaymallén</option>
            </select>
            @if ($errors->has('departamento'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('departamento') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="name" class="control-label col-form-label">Observaciones</label>
        </div>
        <div class="col-sm-5">
            <textarea type="text" class="form-control {{ $errors->has('observaciones') ? ' is-invalid' : '' }} summernote"  name="observaciones" >{{ old('observaciones', $solicitud->observaciones)  }}</textarea>
            @if ($errors->has('observaciones'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('observaciones') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @if($solicitud->estado !== 'CONFIRMADO')
        <div class="form-group row">
            <div class="col-sm-2">
                <label for="estado" class="control-label col-form-label">Estado</label>
            </div>
            <div class="col-sm-3">
                <select id="cbEstado" class="combo form-control custom-select {{ $errors->has('estado') ? ' is-invalid' : '' }}" name="estado">
                    <option value="-1"></option>
                    <option value="SOLICITADO" @if($solicitud->estado == "SOLICITADO") selected @endif>SOLICITADO</option>
                </select>                
                @if ($errors->has('estado'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('estado') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @else
    <div class="form-group row">
        <div class="col-sm-2">
            <label for="estado" class="control-label col-form-label">Estado</label>
        </div>
        <div class="col-sm-3">
            <label for="estado" class="control-label col-form-label">{{$solicitud->estado}}</label>
        </div>
    </div>
    @endif
    
    
</div>
<hr>
@push('scripts')
    <script>
        var vstate = null;
        var _fecha = null;
        var load = true;
        

        $('#fecha_nacimiento').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
            locale: 'es-es',
        });
        
    </script>
@endpush
    