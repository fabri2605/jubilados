var vstate = null;
var _fecha = null;
var load = true;

$('#fecha_turno').datepicker({
uiLibrary: 'bootstrap4',
format: 'dd/mm/yyyy',
locale: 'es-es',


});
$('#fecha_turno').on('change',function(){
    let val = $(this).val();
    let tramite = $('#cbTipoTramite').val();
    let restriccion_covid = $('#restriccion_covid').val();
    let documento = $('#documento').val();
    let turno_id = $('#turno_id').val();

    if(documento || turno_id){
        if(_fecha != val){
            _fecha = val;
            let valid = true;

            if(restriccion_covid == 1){
                let weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                let parts = val.split('/');
                let a = new Date(parts[2]+'-'+parts[1]+'-'+parts[0]);
                let dia_seleccionado = weekday[a.getDay()+1];
                let last_digit = $('#documento').val().substr($('#documento').val().length - 1);

                if(parseInt(last_digit) < 6){
                    if((dia_seleccionado == 'Monday' || dia_seleccionado == 'Wednesday' || dia_seleccionado == 'Friday')){
                        valid = true;
                    }else{
                        valid = false;
                    }
                }else{
                    if((dia_seleccionado == 'Tuesday' || dia_seleccionado == 'Thursday')){
                        valid = true;
                    }else{
                        valid = false;
                    }
                }
            }
            if(valid){
                $.post("/sitio/verificar/",{fecha:val, tramite_id: tramite},
                    function(data, status){
                        //listHorarios
                        if(data.status == 'success'){
                            $('#cbHorarios').empty();
                            $('#cbHorarios').hide('slow');
                            if(data.turnos){
                                $('#cbHorarios').show('slow');
                                if(turno_id && load){
                                    horario_seleccionado = $('#turno_hora').val();
                                    let seleccionado = new Option(horario_seleccionado, horario_seleccionado, false, true);
                                    $('#cbHorarios').append(seleccionado);
                                    load = false;
                                }
                                for(let elemento in data.turnos) {
                                    var item = data.turnos[elemento];
                                    let sub = new Option(item, item, false, (vstate == item ? true : false));
                                    $('#cbHorarios').append(sub);
                                }
                            }
                            if(data.type == 1){
                                $('#titulo_horarios').html('Horarios por Orden de Llegada ')
                            }else{
                                $('#titulo_horarios').html('Horarios Disponbles ')
                            }

                            
                        }else{
                            $('#cbHorarios').empty();
                            $('#cbHorarios').show('slow');
                            showMsg('Advertencia!',data.msg,'red');
                        }
                        
                    }
                );//aca termina el POST
            }else{
                $('#listHorarios').empty();
                $('.horarios').hide('slow');
                $('#titulo_horarios').html('');
                showMsg('Advertencia!', 'Debido a la terminación de su DNI no puede solicitar turno el día seleccionado','red');
            }
        }
    }else{
        showMsg('Advertencia!', 'Debe ingresar un nro de documento para poder verificar los horarios disponibles','red');
        window.location.href = "#documento";
    }    
    
});
$('#fecha_turno').change();