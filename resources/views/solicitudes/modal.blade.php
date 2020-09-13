<div class="modal fade" id="reporteModal" tabindex="-1" role="dialog" aria-labelledby="cancelarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header btn-lasheras" >
          <h5 class="modal-title btn-lasheras" id="cancelarModalLabel">Reporte Solicitudes </h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col col-lg-4 col-xs-8">
                    <label for="nombrePila">Fecha Desde </label><br>
                    <input id="df_consulta_reporte_desde" type="text">
                </div>
                <div class="col col-lg-4 col-xs-8">
                    <label for="nombrePila">Fecha Hasta </label><br>
                    <input id="df_consulta_reporte_hasta" type="text">
                </div>
            </div>
            <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success btn-sm" id="btnConsultaReporte">Generar Reporte</button>
        </div>
      </div>
    </div>
  </div>