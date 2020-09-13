@push('local-style')
<style>

</style>
@endpush
<div class="col-xs-12 col-lg-12 " style="margin-top:10px; margin-bottom: 10px;">
    <div class="row">
        <button type="button" class="btn btn-success cblanco btn-sm col-lg-1 col-xs-7" onclick="window.location='{{ route('solicitudes.create') }}'">
            <i class="ti-plus"></i>
            Nuevo
        </button>
        &nbsp;
        <button type="button" class="btn btn-danger cblanco btn-sm col-lg-1 col-xs-7" data-toggle="modal" data-target="#reporteModal" >
            <i class="ti-download"></i>
            Reporte
        </button>
    </div>
</div>
<br>
<hr>
<div class="col-lg-12">
    <table id="solicitudes-table" class="table no-footer table-reclamos table-striped table-bordered table-hover" role="grid" cellspacing="0" style="width:100%">
      <thead class="bg-info">
        <tr role="row">
            <th style="color:#fff">Nro Solicitud</th>
            <th style="color:#fff">Fecha</th>
            <th style="color:#fff">CUIT</th>
            <th style="color:#fff">Apellido</th>
            <th style="color:#fff">Nombre</th>
            <th style="color:#fff">Celular</th>
            <th style="color:#fff">Email</th>
            <th style="color:#fff">Abono</th>
            <th style="color:#fff">Acciones</th>
        </tr>
      </thead>
    </table>
  </div>
  @push('scripts')
  <script type="text/javascript">
        var _dialog_msg = null;
        var _dialog_msg_consulta = null;
        var _rechazdo_id = null;
        $(function () {
            
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
             });
            
            function callBackSearch(){
                if(_dialog_msg != null){
                    _dialog_msg.close();
                }
            }
            
            var table = $('#solicitudes-table').DataTable({
               
                processing: true,
                serverSide: true,
                responsive: true,
                lengthMenu: [30,60,90,120],
                language: {
                    "lengthMenu": "_MENU_ por página",
                    "zeroRecords": "No hay resultados",
                    "info": "mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrando de _MAX_ registros totales)",
                    "search": "Buscar",
                    "paginate": {
                        first:      "Primera",
                        previous:   "Anterior",
                        next:       "Siguiente",
                        last:       "Ultima"
                    },
                },
                dom: '<"top"Bf>rt<"bottom"lip><"clear">',
                buttons: [
                    'csv', 'excel', 'print'
                ],
                scrollX: true,
                ajax: {
                    url: "{{ route('solicitudes.index') }}",
                },
                columns: [
                    {data: 'nro_solicitud', name: 'nro_solicitud'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'cuit', name: 'cuit'},
                    {data: 'apellido', name: 'apellido'},
                    {data: 'nombre', name: 'nombre'},
                    {data: 'celular', name: 'celular'},
                    {data: 'email', name: 'email'},
                    {data: 'tipo_abono', name: 'tipo_abono'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                columnDefs: [
                ],
                drawCallback: function( settings ) {
                        console.log('dibujar ', settings.json.recordsFiltered);
                        $('#registros').html(settings.json.recordsFiltered);
                        $('#total').html(settings.json.recordsTotal);
                        callBackSearch();
                }
            });
            $('body').on('click', '.eliminarSolicitud', function () {
                var product_id = $(this).data("id");
                console.log($(this).data("id"));
                $.confirm({
                    title: 'Advertencia',
                    content: 'Desea eliminar la solicitud seleccionada?',
                    icon: 'mdi mdi-alert-circle '+'red',
                    buttons: {
                        aceptar: {
                            text: 'Eliminar',
                            btnClass: 'btn-success',
                            keys: ['enter', 'shift'],
                            action :function () {
                                $.ajax({
                                    url: "solicitudes/eliminar/"+product_id,
                                    method: 'DELETE',
                                }).done(function(data) {
                                    if(data.status == 'success'){
                                        showMsg('Información!', data.msg,'green');
                                        table.draw();
                                    }else{
                                        showMsg('Advertencia!', data.msg,'red');
                                    }
                                });
                            }
                        },
                        cancelar: {
                            text: 'Cancelar',
                            btnClass: 'btn-danger',
                            keys: ['enter', 'shift'],
                            action: function () {
                            
                            }
                        },
                      
                    },
                    
                });
            });
            $('#df_consulta_desde').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'dd/mm/yyyy',
                locale: 'es-es',
            });
            $('#df_consulta_hasta').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'dd/mm/yyyy',
                locale: 'es-es',
            });
            $('#btnConsultaReporte').on('click', function(){
                let fecha_desde = $('#df_consulta_desde').val();
                let fecha_hasta = $('#df_consulta_hasta').val();
                if(fecha_desde && fecha_hasta ){
                    _dialog_msg_consulta = $.dialog({
                        title: 'Obteniendo información ...',
                        content: 'Este proceso puede demorar unos segundos',
                        closeIcon: false,
                        theme: 'material'
                    });
                    let params = {fecha_desde: fecha_desde, fecha_hasta: fecha_hasta};
                    $.ajax({
                        xhrFields: {
                            responseType: 'blob',
                        },
                        type: 'POST',
                        url: 'solicitudes/generar/reporte/',
                        data: params,
                        success: function(result, status, xhr) {
                            if(_dialog_msg_consulta != null){
                                _dialog_msg_consulta.close();
                            }
                            var blob = new Blob([result], {
                                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                            });
                            var link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = 'reporte';

                            document.body.appendChild(link);

                            link.click();
                            document.body.removeChild(link);
                        }
                    });
                
                }else{
                    showMsg('Advertencia','Debe seleccionar el rango de fechas sobre la cuál desea consultar', 'red');
                }
            });
        });
  </script>
  @endpush