@push('local-style')
<style>
.dataTables_wrapper .dataTables_filter {
    float: right;
    text-align: right;
    visibility: hidden;
    }
</style>
@endpush
<div class="col-xs-12 col-lg-12 " style="margin-top:10px; margin-bottom: 10px;">
    <div class="row">
        <!--<button type="button" class="btn btn-info cblanco btn-sm col-lg-1 col-xs-7" data-toggle="modal" data-target="#consultaModal" >
            <i class="ti-search"></i>
            Disponiblidad
        </button>!-->
    </div>
</div>
<br>
<hr>
<div class="row" style="padding:10px; ">
    <div class="container">
        
        <div class="row">
            <div class="col col-lg-3 col-xs-5">
                <label for="nombrePila">Fecha Turno</label><br>
                <input type="text" id="df_fecha_turno" >
            </div>
            <div class="col col-lg-3 col-xs-4">
                <label for="nombrePila">Nro Turno</label><br>
                <select id="cbNroTurnos" name="nro_turnos" class="select2 form-control "></select>
            </div>
            <div class="col col-lg-4 col-xs-5">
                <label for="nombrePila">Documento</label><br>
                <select id="cbDocumento" name="expediente" class="select2 form-control "></select>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-3 col-xs-6">
                <label for="nombrePila">Estado</label><br>
                <select  name="estado" id="cbEstado" class="select2 form-control custom-select">
                    <option value="-1"></option>
                    <option value="COMPLETADO">COMPLETADO</option>
                    <option value="CONFIRMADO">CONFIRMADO</option>
                    <option value="PENDIENTE">PENDIENTE</option>
                    <option value="PREVIO">PREVIO</option>
                    <option value="RECHAZADO">RECHAZADO</option>
                </select>
            </div>
            <div class="col col-lg-3 col-xs-6">
                <label for="nombrePila">Localidad</label><br>
                <select  name="estado" id="cbLocalidad" class="select2 form-control custom-select">
                    <option value="-1"></option>
                    <option value="Gran Mendoza">GRAN MENDOZA</option>
                    <option value="San Rafael">SAN RAFAEL</option>
                </select>
            </div>
            <div class="col col-lg-3 col-xs-6">
                <label for="nombrePila">Oficina</label><br>
                <select  name="tramite" id="cbOficina" class="select2 form-control custom-select">
                    @if($oficinas)
                        <option value="-1"></option>
                        @foreach($oficinas as $item)
                            <option value="{{$item->id}}">
                                {{$item->denominacion}}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="clearfix visible-sm"></div>
            <div class="col col-lg-2 col-xs-4">
                <button type="button" class="btn bprimario cblanco btn-circle to-bottom " id="btnBuscar">
                    <i class="fas fa-search icon-v"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <br>
            <div class="col col-lg-12 col-xs-12">
                <label for="nombrePila">Registros Encontrados <span style="font-size: 1.1rem; font-weight: bold" id="registros"></span> de <span style="font-size: 1.1rem; font-weight: bold" id="total"></label><br>
            </div>
        </div>
    </div>
</div>
<hr>    
<div class="col-lg-12">
    <table id="turnos-table" class="table no-footer table-reclamos table-striped table-bordered table-hover" role="grid" cellspacing="0" style="width:100%">
      <thead class="bg-secondary">
        <tr role="row">
            <th style="color:#fff">Nro Turno</th>
            <th style="color:#fff">Hora Turno</th>
            <th style="color:#fff">Fecha Turno</th>
            <th style="color:#fff">Oficina</th>
            <th style="color:#fff">Documento</th>
            <th style="color:#fff">Nombre</th>
            <th style="color:#fff">Apellido</th>
            <th style="color:#fff">Teléfono</th>
            <th style="color:#fff">Estado</th>
            <th style="color:#fff">ID O</th>
            <th style="color:#fff">Localidad</th>
            <th style="color:#fff">Acciones</th>
        </tr>
      </thead>
    </table>
  </div>
  @push('scripts')
    <script type="text/javascript" src="/js/backend/turnos/turnos.min.js?v=12"></script>
    <script type="text/javascript" src="/js/libs/jquery-ui.min.js"></script>
  @endpush