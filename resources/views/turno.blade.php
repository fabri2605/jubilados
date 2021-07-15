<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Turnero SUBE</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="/css/estilo.css" rel="stylesheet">
        <!--<link href="/css/bootstrap.css" rel="stylesheet">!-->
        <link rel="stylesheet" href="/site/css/bootstrap.min.css">
        <link href="/css/mdb.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/datepicker.css">
        <link rel="stylesheet" href="/css/jquery-confirm.min.css">
        <link rel="stylesheet" type="text/css" href="/css/select2.min.css">
    </head>
    <style>
        #map{
            width: 100%;
            height: 500px;
        }
        @media screen and (min-width: 0px) and (max-width: 480px){
            div.calendarPicker{
                width: 90%;
                margin: 0 auto;
            }
        }
        @media screen and (min-width: 481px) and (max-width: 768px){
            div.calendarPicker{
                width: 70%;
                margin: 0 auto;
            }
        }
        @media screen and (min-width: 769px) {
            div.calendarPicker{
                width: 40%;
                margin: 0 auto;
            }
        }

    </style>
    <body>
       <header class="sube-header">
           <div class="sube-logo">
               <img src="/images/sube_logo_blanco.png">
               <p class="sube-text">Viajar con SUBE es más rápido, fácil y cómodo</p>
               <p class="sube-text">Solicita turno y obtenela</p>
           </div>
       </header>
       <main class="py-4">
           <div class="content">
              <div class="clearfix"></div><br>
               <div class="row" style="margin: 0 auto !important">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                <strong>{!! \Session::get('error') !!}</strong>
                            </div>
                        @endif
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <strong>{!! \Session::get('success') !!}</strong>
                            </div>
                        @endif
                        @include('sweetalert::alert')
                        <div class="col-md-2 center-block"></div>
                        <div class="col-md-8 center-block">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                <h3 class="panel-title">Formulario de Registro</h3>
                                </div>
                                <div class="panel-body">
                                   
                                    <form role="form"  method="POST" action="{{ route('sitio.registrar_turno') }}"  >
                                        @csrf
                                        <div class="row">
                                              <div class="form-group col-md-6">
                                                <label for="Nombre ">* Localidad</label>
                                                <select name="localidad" class="form-control select2 custom-select" id="cbLocalidad" >
                                                        <option value=""></option>
                                                        <option value="San Rafael" selected>San Rafael</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                    <label for="Nombre ">* Oficina</label>
                                                    <select name="oficina_id" class="form-control select2 custom-select" id="cbOficina" required>
                                                    </select>
                                                    <button type="button" id="btnMapa" class="btn btn-primary" >
                                                        Ver ubicación
                                                    </button>
                                                    <button type="button" style="display: none" id="btnOpen" data-toggle="modal" data-target="#modalMap">
                                                        abrirModal
                                                    </button>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Nombre ">* Nombre</label>
                                                <input type="text" class="form-control" id="txtNombre" name="nombre" value="{{old('nombre')}}"  required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Apellido">* Apellido</label>
                                                <input type="text" class="form-control" id="txtApellido" name="apellido" value="{{old('apellido')}}"  required>
                                            </div>
                                            <div class="clearfix"></div>
                                            
                                            <div class="form-group col-md-6">
                                                <label for="Documento ">* DNI</label>
                                                <input type="number" class="form-control" id="txtDocumento" name="documento" value="{{old('documento')}}"  required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Documento "> Correo Electrónico</label>
                                                <input type="email" class="form-control" id="txtEmail" name="email" value="{{old('email')}}" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="Documento "> Celular</label>
                                                <input type="number" class="form-control" id="txtCelular" name="telefono" value="{{old('telefono')}}" >
                                            </div>
                                            <div class="col-md-12" id="loading"></div>
                                            <div class="form-group col-md-12" >
                                                <h3 class="main_question"><strong></strong>Día :</h3>
                                                <input type="hidden" id="fechaTurno" name="fechaTurno" value="2021-06-01">
                                                <div class="form-group fecha-solicitud calendarPicker">
                                                    <div id="fechaPicker"></div>
                                                    <hr>
                                                    <p class="leyenda">
                                                        Disponible <span></span>
                                                        No disponible <span></span>
                                                        Seleccionado <span></span>
                                                    </p>
                                                </div>
                                                <button id="btnUpdate" style="display: none" type="button" onclick="buscarDisponibilidad()" class="btn btn-primary" >
                                                  Actualizar
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="form-group col-md-12">
                                                <label for="Nombre ">* Horarios</label>
                                                <p>Horarios Disponibles para el día seleccionado</p><br/>
                                                <select name="hora_turno" class="form-control" id="cbHorarios" required>
                                                </select>
                                                
                                            </div>
                                            <br>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success">Solicitar Turno</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 center-block"></div>
                </div>
           </div>
           <div>
                @if ($errors->has('documento') || $errors->has('hora_turno'))
                    @if ($errors->has('documento'))
                        <input id="edni" type="hidden" name="documento" value="{{ $errors->first('documento') }}" >
                    @endif
                    @if ($errors->has('hora_turno'))
                        <input id="edni" type="hidden" name="documento" value="{{ $errors->first('hora_turno') }}" >
                    @endif
                @endif
                @isset($msg)
                    <input id="msg" type="hidden" value="{{$msg}}">
                @endisset
           <div>
        </main>
        <div class="modal fade" id="modalMap" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMapLabel">Ubicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
       <script src="/libs/jquery.min.js" ></script>
       <script src="/js/jquery-confirm.min.js"></script>
       <script src="/js/popper.min.js" ></script>
       <script src="/js/bootstrap.min.js" ></script>
       <script src="/js/messages.js"></script> 
       <script src="/js/select2.min.js"></script>
       <script type="text/javascript" src="/js/front/horarios.min.js?v=40"></script>
       <script type="text/javascript" src="/libs/jquery-ui.min.js"></script>
       <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl3oO_Wj-tdmSKVwPVM6FoRouI-dupG1s&callback=initMap" async defer></script>
       <script>
           var map;
           var oficina_actual = null;
           
           
           $(document).ready(function(){
                $('#cbOficina').on('change', function(){
                    $("#cbHorarios").empty();
                    $('#fechaPicker' ).datepicker( "destroy" );
                    let value = $('#cbLocalidad').val();
                    if(value){
                        
                        buscarDisponibilidad();
                        
                    }
                });
               // $('#cbOficina').change();

                $('#cbLocalidad').on('change', function(){
                    $('#cbOficina').empty();
                    let value = $('#cbLocalidad').val();
                    if(value){
                        let url = '/sitio/obtener/oficinas/'
                        $.ajax( {url: url, type: "POST", data: {localidad: value}} )
                            .done(function(result) {
                                if(result.status == 'success'){
                                    var option = new Option('Seleccione una oficina', '');
                                    $('#cbOficina').append(option);

                                    result.data.forEach(element => {
                                        var option = new Option(element.denominacion, element.id);
                                        $('#cbOficina').append(option);
                                    });
                                }else{
                                    showMsg('Advertencia!', result.msg,'red');
                                }
                            })
                            .fail(function() {
                        });
                    }
                });
                $('#dfFecha').on('change', function(){
                    let value = $('#dfFecha').val();
                    let date = new Date(value);
                    var isWeekend = (date.getDay() === 6); 
                    var inicio = new Date('2020-01-06');
                    if(!(date.getTime() < inicio.getTime())){
                            if(isWeekend){
                                showMsg('Advertencia!', 'Debe seleccionar un día entre Lunes y Sábado','red');
                                $('#cbHorarios').empty();
                            }else{
                                let oficina = $('#cbOficina').val();
                                let url = '/api/oficinas/horarios/'+oficina+'/'+value;
                                if(oficina == '-1'){
                                    showMsg('Advertencia!', 'Debe seleccionar una oficina para visualizar los horarios disponibles','red');
                                }else{
                                    $.ajax( url )
                                    .done(function(data) {
                                        $('#cbHorarios').empty();
                                        if(data.status == 'success'){
                                            data.data.forEach(element => {
                                                var option = new Option(element, element);
                                                $('#cbHorarios').append(option);
                                            });
                                        }else{
                                            showMsg('Advertencia!', data.msg,'red');
                                        }
                                    })
                                    .fail(function() {
                                    });
                                }
                            }
                    }else{
                        showMsg('Advertencia!', 'No se pueden solicitar turnos antes del día 06/01/2019, disculpe las molestias.','red');
                    }
                });
                   
                $('#btnMapa').on('click', function(){
                    let value = $('#cbOficina').val();
                    if(value){
                        let url = '/sitio/oficinas/obtener/coordenadas/'+value;
                        $.ajax( url )
                        .done(function(data) {
                            var myLatLng = {lat: Number(data.lat), lng: Number(data.lng)};
                            if(oficina_actual != null){
                                oficina_actual.setMap(null);
                            }
                            oficina_actual = new google.maps.Marker({
                                position: myLatLng,
                                map: map,
                                title: data.denominacion
                            });
                            console.log(map);
                            map.setCenter(myLatLng);
                            map.setZoom(15);
                        })
                        .fail(function() {
                        });
                        $('#btnOpen').trigger('click');
                    }else{
                        showMsg('Advertencia!','Debe seleccionar una oficina para ver su ubicación','red');
                    }
                });
                $(".select2").select2({
                    allowClear: true,
                    placeholder: {
                        id: '', // the value of the option
                        text: 'Seleccione una opción'
                    },
                    "language": {
                        "noResults": function(){
                            return "No hay horarios disponibiles";
                        }
                    }
                });
                $("#cbHorarios").select2({
                    allowClear: true,
                    placeholder: {
                        id: '', // the value of the option
                        text: 'Seleccione una opción'
                    },
                    "language": {
                        "noResults": function(){
                            return "No hay horarios disponibiles";
                        }
                    }
                });
                $("#btnUpdate").on('click', function(){
                    $('#dfFecha').change();
                });

                $('#cbLocalidad').trigger("change");
           });

           function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -32.886333, lng: -68.8400085},
                    zoom: 13
                });
            }
       </script>
       
    </body>

</html>
