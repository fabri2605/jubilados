@push('local-style')
<style>

</style>
@endpush
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">  
<div class="col-xs-12 col-lg-12 " style="margin-top:10px; margin-bottom: 10px;">
    <div class="row">
        <button type="button" class="btn btn-danger cblanco btn-sm col-lg-2 col-xs-7" id="btnImportar" >
            <i class="ti-cloud"></i>
            Importar Registros
        </button>
    </div>
</div>
<br>
<hr>
<div class="col-lg-12">
    <table id="enviado_san_rafael-table" class="table no-footer table-reclamos table-striped table-bordered table-hover" role="grid" cellspacing="0" style="width:100%">
      <thead class="bg-info">
        <tr role="row">
            <th style="color:#fff">Documento</th>
        </tr>
      </thead>
    </table>
  </div>
  @push('scripts')
  <script type="text/javascript">
        var _dialog_msg = null;
        var _dialog_msg_consulta = null;
        var _rechazdo_id = null;
        function uploadFile(evt){
                var file = document.getElementById(evt.id).files[0];
                if(file){
                    var formData = new FormData();
                    formData.append('file', file);
                    _dialog_msg = $.dialog({
                        title: 'Subiendo archivo  ...',
                        content: 'Por favor espere....',
                        closeIcon: false,
                        theme: 'material'
                    });
                    $.ajax({
                        url: '/enviado_san_rafael/importar/',  
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.getElementsByName('_token')[0].value
                        },
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            if(_dialog_msg != null){
                                _dialog_msg.close();
                            }
                            if(response.status == 'success'){
                                showMsg('Aviso', 'Archivo importado!');
                                $('#modalImportar').modal('toggle');
                            }
                        },
                        error: function(response){
                            if(_dialog_msg != null){
                                _dialog_msg.close();
                            }
                        }
                    });

                }
            }
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
            var table = $('#enviado_san_rafael-table').DataTable({
               
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
                    url: "{{ route('enviado_san_rafael.index') }}",
                },
                columns: [
                    {data: 'documento', name: 'documento'},
                ],
                columnDefs: [
                ],
                drawCallback: function( settings ) {
                        $('#registros').html(settings.json.recordsFiltered);
                        $('#total').html(settings.json.recordsTotal);
                        callBackSearch();
                }
            });
            $('#btnImportar').on('click',function(){
                $('#modalImportar').modal('show');
            })
            
        });
  </script>
  @endpush