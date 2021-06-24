$('.summernote').summernote({
  height: 200, // set editor height
  minHeight: null, // set minimum height of editor
  maxHeight: null, // set maximum height of editor
  focus: false // set focus to editable area after initializing summernote
});
$('.llegada').on('click',function(){
  let id = $(this)[0].id;
  let idparts = id.split('-');

  if($(this).is(':checked')){
      $('.fila-'+idparts[1]).prop("readonly", true);
      $('#hora_inicio-'+idparts[1]).val('00:00:00');
      $('#hora_fin-'+idparts[1]).val('00:00:00');
      $('#hora_inicio_tarde-'+idparts[1]).val('00:00:00');
      $('#hora_fin_tarde-'+idparts[1]).val('00:00:00');
      $('#tiempo_minutos-'+idparts[1]).val('0');
      $('#tiempo_minutos_tarde-'+idparts[1]).val('0');
      $('#valor_llegada-'+idparts[1]).val(1);

      $('#hora_inicio-'+idparts[1]).prop("readonly", false);
      $('#hora_inicio_tarde-'+idparts[1]).prop("readonly", false);
  }else{
      $('.fila-'+idparts[1]).prop("readonly", false);
      $('#valor_llegada-'+idparts[1]).val(0);
  }
  
});
$('.calcular').on('focusout',function(){
  
  let id = $(this)[0].id;
  let idparts = id.split('-');

  let fecha_inicio = $('#fecha_inicio-'+idparts[1]).val();
  let fecha_fin = $('#fecha_fin-'+idparts[1]).val();
  
  let hora_inicio = $('#hora_inicio-'+idparts[1]).val();
  let hora_fin = $('#hora_fin-'+idparts[1]).val();

  let hora_inicio_tarde = $('#hora_inicio_tarde-'+idparts[1]).val();
  let hora_fin_tarde = $('#hora_fin_tarde-'+idparts[1]).val();

  if(fecha_inicio && fecha_fin && hora_inicio && hora_fin){
      

      let f1 = new Date(fecha_inicio+' '+hora_inicio);
      let f2 = new Date(fecha_inicio+' '+hora_fin);

      var diff = f2.getTime() - f1.getTime();
      let diffMins = (diff / 60000);

      if(diffMins > 0 ){
          let turnos = $('#cantidad_turnos-'+idparts[1]).val();
          if(turnos){
              let tiempo = parseInt(diffMins/turnos);
              if(tiempo > 0){
                  $('#tiempo_minutos-'+idparts[1]).val(tiempo);
              }
          }
      }
  }
  //TARDE
  if(fecha_inicio && fecha_fin && hora_inicio_tarde && hora_fin_tarde){
      let f1tarde = new Date('2020-08-08'+' '+hora_inicio_tarde);
      let f2tarde = new Date('2020-08-08'+' '+hora_fin_tarde);

      let diffMst = f2tarde-f1tarde;
      let diffHrst = Math.floor((diffMst%86400000)/3600000);
      var diffMinst = diffHrst*60;
      if(diffMinst > 0 ){
          let turnos_tarde = $('#cantidad_turnos_tarde-'+idparts[1]).val();
          if(turnos_tarde){
              let tiempo = parseInt(diffMinst/turnos_tarde);
              if(tiempo > 0){
                  $('#tiempo_minutos_tarde-'+idparts[1]).val(tiempo);
              }
          }
      }
  }
  
});