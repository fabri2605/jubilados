<div class="modal fade" id="modalImportar"  role="dialog" aria-labelledby="modalImportRegistroLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #3e5569; color: #fff">
          <h5 class="modal-title" id="exampleModalLabel" style="background-color: #3e5569; color: #fff">Importar Entregas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                <form id="frmImportarEnlaces" class="form-horizontal striped-rows b-form" >
                        <div class="form-group row">
                          <div class="col-md-5">
                              <div>
                                  <label for="alias" class="control-label col-form-label">Adjunte el archivo en formato Excel. </label>
                                  <small id="emailHelp" class="form-text text-muted">Recuerde que la primer fila no será leída y contada como el titulo de la columna</small>
                              </div>
                          </div>
                          <div class="col-md-7">
                            <input type="file" name="archivo_importar" id="archivo_importar" onchange="uploadFile(this)" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  >
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        </div>
      </div>
    </div>
  </div>