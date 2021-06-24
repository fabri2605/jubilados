
<div class="card-body">
  <h4 class="card-title">Información del Solicitante</h4>
  @csrf  
  <input type="hidden" id="restriccion_covid" name="restriccion_covid" class="form-control" value="{{$parametro->restriccion_covid}}" >
  <input type="hidden" id="turno_id" name="turno_id" class="form-control" value="{{ ($turno ? $turno->id : null) }}" >
  <input type="hidden" id="turno_hora" name="turno_hora" class="form-control" value="{{ ($turno ? $turno->hora_turno : null) }}" >
  <div class="form-group row">
      <div class="col-sm-2">
          <label for="name" class="control-label col-form-label">Nombre</label>
      </div>
      <div class="col-sm-5">
          <input type="text" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" name="nombre"  value="{{ old('nombre', $turno->nombre)  }}">
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
          <input type="text" class="form-control {{ $errors->has('apellido') ? ' is-invalid' : '' }}" id="apellido" name="apellido"  value="{{ old('apellido', $turno->apellido)  }}">
          @if ($errors->has('apellido'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('apellido') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group row">
      <div class="col-sm-2">
          <label for="name" class="control-label col-form-label">Documento</label>
      </div>
      <div class="col-sm-3">
          <input type="number" class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}" id="documento" name="documento"  value="{{ old('documento', $turno->documento)  }}">
          @if ($errors->has('documento'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('documento') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group row">
      <div class="col-sm-2">
          <label for="name" class="control-label col-form-label">Email</label>
      </div>
      <div class="col-sm-5">
          <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email"  value="{{ old('email', $turno->email)  }}">
          @if ($errors->has('email'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group row">
      <div class="col-sm-2">
          <label for="name" class="control-label col-form-label">Calle</label>
      </div>
      <div class="col-sm-5">
          <input type="text" class="form-control {{ $errors->has('calle') ? ' is-invalid' : '' }}" id="calle" name="calle"  value="{{ old('calle', $turno->calle)  }}">
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
          <input type="number" class="form-control {{ $errors->has('nro') ? ' is-invalid' : '' }}" id="nro" name="nro"  value="{{ old('nro', $turno->nro)  }}">
          @if ($errors->has('nro'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('nro') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <hr>
  <br>
  <h4 class="card-title">Información Turno</h4>
  @if($turno->estado !== 'CONFIRMADO')
      <div class="form-group row">
          <div class="col-sm-2">
              <label for="estado" class="control-label col-form-label">Estado</label>
          </div>
          <div class="col-sm-3">
              <select id="cbEstado" class="combo form-control custom-select {{ $errors->has('estado') ? ' is-invalid' : '' }}" name="estado">
                  <option value="-1"></option>
                  <option value="COMPLETADO" @if($turno->estado == "COMPLETADO") selected @endif>COMPLETADO</option>
                  <option value="CONFIRMADO" @if($turno->estado == "CONFIRMADO") selected @endif>CONFIRMADO</option>
                  <option value="PENDIENTE"  @if($turno->estado == "PENDIENTE") selected @endif>PENDIENTE</option>
                  <option value="PREVIO"     @if($turno->estado == "PREVIO") selected @endif>PREVIO</option>
                  <option value="RECHAZADO"  @if($turno->estado == "RECHAZADO") selected @endif>RECHAZADO</option>
                  <option value="REPROGRAMADO" @if($turno->estado == "REPROGRAMADO") selected @endif>REPROGRAMADO</option>
                  <option value="VENCIDO" @if($turno->estado == "VENCIDO") selected @endif>VENCIDO</option>
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
          <label for="estado" class="control-label col-form-label">{{$turno->estado}}</label>
      </div>
  </div>
  @endif
  @if($turno->estado !== 'CONFIRMADO')
  <div class="form-group row">
      <div class="col-sm-2">
              <label for="juzgado_id" class="control-label col-form-label">Tipo Trámite</label>
      </div>
      <div class="col-sm-3">
          <select id="cbTipoTramite" class="combo form-control custom-select {{ $errors->has('tipo_tramite_id') ? ' is-invalid' : '' }}" name="tipo_tramite_id">
              @if($tipo_tramites)
                  <optgroup label="Seleccione un trámite">
                      @foreach($tipo_tramites as $item)
                          <option value="{{$item->id}}"
                                  @if($turno->tipo_tramite_id == $item->id)
                                      selected
                                  @endif
                          >{{$item->denominacion}}</option>
                      @endforeach
                  </optgroup>
              @endif
          </select>                
          @if ($errors->has('tipo_tramite_id'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('tipo_tramite_id') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group row">
      <div class="col-sm-2">
          <label for="name" class="control-label col-form-label">Fecha Turno</label>
      </div>
      <div class="col-sm-3">
          <input type="text" class="form-control {{ $errors->has('fecha_turno') ? ' is-invalid' : '' }}" id="fecha_turno" name="fecha_turno"  value="{{ old('fecha_turno', ($turno->fecha_turno ? \Carbon\Carbon::parse($turno->fecha_turno)->format('d/m/Y') : ''))  }}">
          @if ($errors->has('fecha_turno'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('fecha_turno') }}</strong>
              </span>
          @endif
      </div>
  </div>
  <div class="form-group row">
      <div class="col-sm-2">
              <label for="juzgado_id" class="control-label col-form-label">Horarios Disponibles</label>
      </div>
      <div class="col-sm-3">
          <select id="cbHorarios" class="combo form-control custom-select {{ $errors->has('tipo_tramite_id') ? ' is-invalid' : '' }}" name="hora_turno">
          </select>                
          @if ($errors->has('hora_turno'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('hora_turno') }}</strong>
              </span>
          @endif
      </div>
  </div>
@endif
<div class="form-group row">
  <div class="col-sm-2">
      <label for="name" class="control-label col-form-label">Observaciones</label>
  </div>
  <div class="col-sm-5">
      <textarea type="text" class="form-control {{ $errors->has('observacion') ? ' is-invalid' : '' }} summernote"  name="observacion" >{{ old('observacion', $turno->observacion)  }}</textarea>
      @if ($errors->has('observacion'))
          <span class="invalid-feedback">
              <strong>{{ $errors->first('observacion') }}</strong>
          </span>
      @endif
  </div>
</div>
</div>

<hr>
@push('scripts')
  <script src="/js/backend/turnos/turnos.adminj.s"></script>
@endpush
  