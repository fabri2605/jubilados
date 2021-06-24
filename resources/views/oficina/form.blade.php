
<div class="card-body">
    <h4 class="card-title">Información</h4>
    @csrf  
    <div class="form-group row">
        <div class="col-sm-3">
            <div class="b-label">
                <label for="name" class="control-label col-form-label">Denominación</label>
            </div>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control {{ $errors->has('denominacion') ? ' is-invalid' : '' }}" id="denominacion" name="denominacion"  value="{{ old('denominacion', $oficina->denominacion)  }}">
            @if ($errors->has('denominacion'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('denominacion') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            <div class="b-label">
                <label for="name" class="control-label col-form-label">Dirección</label>
            </div>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}" id="direccion" name="direccion"  value="{{ old('direccion', $oficina->direccion)  }}">
            @if ($errors->has('direccion'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('direccion') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            <div class="b-label">
                <label for="name" class="control-label col-form-label">Latitud</label>
            </div>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control {{ $errors->has('lat') ? ' is-invalid' : '' }}" id="lat" name="lat"  value="{{ old('lat', $oficina->lat)  }}">
            @if ($errors->has('lat'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('lat') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            <div class="b-label">
                <label for="name" class="control-label col-form-label">Longitud</label>
            </div>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control {{ $errors->has('lng') ? ' is-invalid' : '' }}" id="lng" name="lng"  value="{{ old('lng', $oficina->lng)  }}">
            @if ($errors->has('lng'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('lng') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            <div class="b-label">
                <label for="name" class="control-label col-form-label">Localidad</label>
            </div>
        </div>
        <div class="col-sm-1">
            <select name="localidad" id="cbLocalidad" style="width: 250px" class="combo form-control custom-select js-example-responsive">
                <option value="Gran Mendoza" @if($oficina->localidad == "Gran Mendoza") selected @endif>Gran Mendoza</option>
                <option value="San Rafael" @if($oficina->localidad == "San Rafael") selected @endif>San Rafael</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            <div class="b-label">
                <label for="name" class="control-label col-form-label">Visbilidad Web</label>
            </div>
        </div>
        <div class="col-sm-1">
            <select name="visibilidad_web" id="cbVisibilidadWeb" style="width: 250px" class="combo form-control custom-select js-example-responsive">
                <option value="1" @if($oficina->visibilidad_web == 1) selected @endif>Sí</option>
                <option value="0" @if($oficina->visibilidad_web == 0) selected @endif>No</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3">
            <div class="b-label">
                <label for="name" class="control-label col-form-label">Aplica Restricción</label>
            </div>
        </div>
        <div class="col-sm-1">
            <select name="aplica_restriccion" id="cbRestriccion" style="width: 250px" class="combo form-control custom-select js-example-responsive">
                <option value="1" @if($oficina->aplica_restriccion == 1) selected @endif>Sí</option>
                <option value="0" @if($oficina->aplica_restriccion == 0) selected @endif>No</option>
            </select>
        </div>
    </div>
    
</div>
<hr>
@php
    function diaNombre($nro){
        if($nro == 1){
            return 'Lunes';
        }else if($nro == 2){
            return 'Martes';
        }else if($nro == 3){
            return 'Miércoles';
        }else if($nro == 4){
            return 'Jueves';
        }else if($nro == 5){
            return 'Viernes';
        }
    }    
@endphp
@foreach($oficina->agendas as $agenda)
    @if($agenda->activa == 1)
        <table name="horarios[]"  class="table table-striped table-bordered table-responsive  " role="grid">
            <thead>
                <tr>
                    <td class="th-header">Día</td>
                    <td class="th-header">Llegada</td>
                    <td class="th-header">F. Inicio</td>
                    <td class="th-header">F. Fin</td>
                    <td class="th-header">H. Inicio</td>
                    <td class="th-header">H. Fin</td>
                    <td class="th-header">Cantidad Turnos</td>
                    <td class="th-header">Tiempo (min)</td>
                    <td class="th-header">H. Inicio Tarde</td>
                    <td class="th-header">H. Fin Tarde</td>
                    <td class="th-header">Cantidad Turnos Tarde</td>
                    <td class="th-header">Tiempo (min) Tarde</td>
                </tr>
            </thead>
            <tbody>
                @foreach($agenda->dias as $item)
                    <tr>
                        <td>{{diaNombre($item->dia_semana)}}</td>
                        <td><input id="llegada-{{$item->id}}" class="form-control llegada" type="checkbox"  @if($item->llegada == 1) checked @endif></td>
                        <td><input type="date" id="fecha_inicio-{{$item->id}}" name="fecha_inicio[]" class="form-control fila-{{$item->id}}"  value="{{($item->fecha_inicio ? $item->fecha_inicio->toDateString() : '')}}" @if($item->llegada == 1) readonly @endif> </td>
                        <td><input type="date" id="fecha_fin-{{$item->id}}" name="fecha_fin[]" class="form-control fila-{{$item->id}}"  value="{{($item->fecha_fin ? $item->fecha_fin->toDateString() : '')}}" @if($item->llegada == 1) readonly @endif> </td>
                        <td><input type="time" id="hora_inicio-{{$item->id}}" name="hora_inicio[]" class="form-control fila-{{$item->id}} calcular"  value="{{($item->hora_inicio ? $item->hora_inicio : '')}}" > </td>
                        <td><input type="time" id="hora_fin-{{$item->id}}" name="hora_fin[]" class="form-control fila-{{$item->id}} calcular"  value="{{($item->hora_fin ? $item->hora_fin : '')}}" @if($item->llegada == 1) readonly @endif> </td>
                        <td><input type="number" style="min-width: 80px !important;" id="cantidad_turnos-{{$item->id}}" name="cantidad_turnos[]" class="form-control calcular"  value="{{($item->cantidad_turnos ? $item->cantidad_turnos : '')}}"> </td>
                        <td><input type="text" id="tiempo_minutos-{{$item->id}}"  name="tiempo_minutos[]" class="form-control fila-{{$item->id}}"  value="{{($item->tiempo_minutos ? $item->tiempo_minutos : '')}}" readonly> </td>
                        
                        <td><input type="time" id="hora_inicio_tarde-{{$item->id}}" name="hora_inicio_tarde[]" class="form-control fila-{{$item->id}} calcular"  value="{{($item->hora_inicio_tarde ? $item->hora_inicio_tarde : '')}}"> </td>
                        <td><input type="time" id="hora_fin_tarde-{{$item->id}}" name="hora_fin_tarde[]" class="form-control fila-{{$item->id}} calcular"  value="{{($item->hora_fin_tarde ? $item->hora_fin_tarde : '')}}" @if($item->llegada == 1) readonly @endif> </td>
                        <td><input type="number" style="min-width: 80px !important;" id="cantidad_turnos_tarde-{{$item->id}}" name="cantidad_turnos_tarde[]" class="form-control  calcular"  value="{{($item->cantidad_turnos_tarde ? $item->cantidad_turnos_tarde : '')}}"> </td>
                        <td><input type="text" id="tiempo_minutos_tarde-{{$item->id}}"  name="tiempo_minutos_tarde[]" class="form-control fila-{{$item->id}}"  value="{{($item->tiempo_minutos_tarde ? $item->tiempo_minutos_tarde : '')}}" readonly> </td>
                        <td style="display: none"><input name="llegada[]" id="valor_llegada-{{$item->id}}" class="form-control" type="text" value="{{$item->llegada}}"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @break
    @endif
@endforeach
    


@push('scripts')
    <script src="/js/backend/oficinas/oficinas.admin.js"></script>
@endpush
    