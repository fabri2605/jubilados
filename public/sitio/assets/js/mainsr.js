$(function() {
    
  // Select Dropdown
  $('html').on('click', function() {
      $('.select .dropdown').hide();
  });
  $('.select').on('click', function(event) {
      event.stopPropagation();
  });
  $('.select .select-control').on('click', function() {
      $(this).parent().next().toggle();
  })
  $('.select .dropdown li').on('click', function() {
      $(this).parent().toggle();
      var text = $(this).attr('rel');
      $(this).parent().prev().find('div').text(text);
  })

  // date picker
  $('.datepicker').datepicker({
      clearBtn: true,
      format: "dd/mm/yyyy"
  });

  $(".step-box-content ").on('click', function() {

      $(".step-box-content").removeClass("active");
      $(this).addClass("active");
  });

  $(".services-select-option li").on('click', function() {

      $(".services-select-option li").removeClass("active");
      $(this).addClass("active");
  });

  $(".opti-list ul li").on('click', function(e) {
      $(this).find('input[type=checkbox]').prop("checked", !$(this).find('input[type=checkbox]').prop("checked"));

      if ($(this).hasClass("active")) {
          $(this).removeClass("active");
      } else {
          $(this).addClass("active");
      }
  });

  $('input[type=checkbox]').click(function(e) {
      e.stopPropagation();
      return true;
  });

  $(".plan-icon-text").on('click', function() {
      $(this).find('input[type=radio]').prop("checked", true);
      $(".plan-icon-text").removeClass("active");
      $(this).addClass("active");
  });

  $('#fecha_nacimiento').on('focusout',function(){
      let val = $('#fecha_nacimiento').val();
      var hoy = new Date();
      var cumpleanos = new Date(val);
      var edad = hoy.getFullYear() - cumpleanos.getFullYear();
      var m = hoy.getMonth() - cumpleanos.getMonth();

      if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
          edad--;
      }
      if(_tipo_abono == "M" && edad < 70){
            $.alert({
                title: 'Advertencia!',
                content: 'Ha seleccionado un abono de Mayor de 70 años y usted no cumple con ese requisito',
            });
      }
  })


  //multi form ===================================
  //DOM elements
  const DOMstrings = {
      stepsBtnClass: 'multisteps-form__progress-btn',
      stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
      stepsBar: document.querySelector('.multisteps-form__progress'),
      stepsForm: document.querySelector('.multisteps-form__form'),
      stepFormPanelClass: 'multisteps-form__panel',
      stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
      stepPrevBtnClass: 'js-btn-prev',
      stepNextBtnClass: 'js-btn-next'
  };


  //remove class from a set of items
  const removeClasses = (elemSet, className) => {

      elemSet.forEach(elem => {

          elem.classList.remove(className);

      });

  };

  //return exect parent node of the element
  const findParent = (elem, parentClass) => {

      let currentNode = elem;

      while (!currentNode.classList.contains(parentClass)) {
          currentNode = currentNode.parentNode;
      }

      return currentNode;

  };

  //get active button step number
  const getActiveStep = elem => {
      return Array.from(DOMstrings.stepsBtns).indexOf(elem);
  };

  //set all steps before clicked (and clicked too) to active
  const setActiveStep = activeStepNum => {

      //remove active state from all the state
      removeClasses(DOMstrings.stepsBtns, 'js-active');
      removeClasses(DOMstrings.stepsBtns, 'current');
      
      //set picked items to active
      DOMstrings.stepsBtns.forEach((elem, index) => {
          if (index <= activeStepNum) {
              elem.classList.add('js-active');
              $(elem).addClass(index);

          }

          if (index == activeStepNum) {
              elem.classList.add('current');
          }


      });
  };

  //get active panel
  const getActivePanel = () => {

      let activePanel;

      DOMstrings.stepFormPanels.forEach(elem => {

          if (elem.classList.contains('js-active')) {

              activePanel = elem;

          }

      });

      return activePanel;

  };

  //open active panel (and close unactive panels)
  const setActivePanel = activePanelNum => {

      const animation = $(DOMstrings.stepFormPanels, 'js-active').attr("data-animation");

      //remove active class from all the panels
      removeClasses(DOMstrings.stepFormPanels, 'js-active');
      removeClasses(DOMstrings.stepFormPanels, animation);
      removeClasses(DOMstrings.stepFormPanels, 'animate__animated');

      //show active panel
      DOMstrings.stepFormPanels.forEach((elem, index) => {
          if (index === activePanelNum) {

              elem.classList.add('js-active');
              // stepFormPanels
              elem.classList.add('animate__animated', animation);

              setTimeout(function() {
                  removeClasses(DOMstrings.stepFormPanels, 'animate__animated', animation);
              }, 1200);

              setFormHeight(elem);

          }
      });

  };


  //set form height equal to current panel height
  const formHeight = activePanel => {

      const activePanelHeight = activePanel.offsetHeight;

      DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;

  };

  const setFormHeight = () => {
      const activePanel = getActivePanel();

      formHeight(activePanel);
  };

  //STEPS BAR CLICK FUNCTION
  DOMstrings.stepsBar.addEventListener('click', e => {

      //check if click target is a step button
      const eventTarget = e.target;

      if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
          return;
      }

      //get active button step number
      const activeStep = getActiveStep(eventTarget);

      //set all steps before clicked (and clicked too) to active
      // setActiveStep(activeStep);

      //open active panel
      // setActivePanel(activeStep);
  });

  //PREV/NEXT BTNS CLICK
  DOMstrings.stepsForm.addEventListener('click', e => {

      const eventTarget = e.target;

      

      //check if we clicked on `PREV` or NEXT` buttons
      if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList.contains(`${DOMstrings.stepNextBtnClass}`))) {
          
          return;
      }

      //find active panel
      const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);

      let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

      
      //set active step and active panel onclick
      if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) ) {
          activePanelNum--;

          setActiveStep(activePanelNum);
          setActivePanel(activePanelNum);

      } else if(eventTarget.classList.contains(`${DOMstrings.stepNextBtnClass}`)  ) { 
      
      /*if(activePanelNum > 0){    
          var form = $('#wizard');
          form.validate();

          var parent_fieldset = $('.multisteps-form__panel.js-active');
          var next_step = true;
          
          parent_fieldset.find('.required').each( function(){
              next_step = false;
              var form = $('.required');
              form.validate();
              $(this).addClass('custom-select is-invalid');
          }); 
          if(next_step === true || form.valid() === true) {
              $("html, body").animate({
                  scrollTop: 0
              }, 600);
              activePanelNum++;
              setActiveStep(activePanelNum);
              setActivePanel(activePanelNum);
          }
  
      }else if(activePanelNum == 0){*/
      // }   

      let tramite, apellido,nombre,cuit,celular,fijo,email,fecha_nacimiento,sexo,documento;
      
      if(activePanelNum == 0){
          tramite = $('#nro_tramite').val();
          repetir = $('#nro_tramite_repetir').val();
          documento = $('#dni').val();
          certificado = $("#file-discapacidad").val();

          console.log(certificado, _tipo_abono);

          if(_tipo_abono == "D" && !certificado){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Debe ingresar un certificado de discapacidad!',
              });
          }else if(!documento){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Debe ingresar el número de documento!',
              });
          }else if(!tramite){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Debe ingresar el número de trámite!',
              });
          }else if(tramite != repetir){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Los Campos de Número de Trámite y el Campo de Repetir Número de Trámite no Coinciden',
              });
          }else if(tramite.length > 11 || tramite.length < 11){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Verifique que el número de trámite tenga la cantidad números correcta',
              });
          }else if(_continuar == false){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Ud. no está registrado como beneficiario jubilado o mayores de 70 años o Discapacidad o ley 7811',
              });
          }else{
              $("html, body").animate({
                  scrollTop: 0
              }, 600);
              activePanelNum++;
              setActiveStep(activePanelNum);
              setActivePanel(activePanelNum);
          }
      }else if(activePanelNum == 1){
          apellido = $('#apellido').val();
          nombre = $('#nombre').val();
          cuit = $('#cuit').val();
          celular = $('#celular').val();
          fijo = $('#fijo').val();
          email = $('#email').val();
          fecha_nacimiento = $('#fecha_nacimiento').val();
          sexo = $("input[name='sexo']:checked").val();
          documento = $('#dni').val();

          if(!apellido){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Ingrese su apellido',
              });
          }else if(apellido.length < 3){
              $.alert({
                  title: 'Advertencia!',
                  content: 'El Apellido debe contener al menos 3 caracteres',
              });
          }else if(!nombre){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Ingrese su nombre',
              });
          }else if(nombre.length < 3){
              $.alert({
                  title: 'Advertencia!',
                  content: 'El Nombre debe contener al menos 3 caracteres',
              });
          }else if(!cuit){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Ingrese su número de cuit/cuil',
              });
          }else if(!celular){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Ingrese su número de celular',
              });
          }else if(celular.length != 15 ){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Debe ingresar todos los dígitos del número de celular',
              });
          }else if(!fecha_nacimiento){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Ingrese su fecha de nacimiento',
              });
          }else if(!sexo){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Seleccione su sexo',
              });
          }else if(!_continuarPaso2){
              $.alert({
                  title: 'Advertencia!',
                  content: 'El DNI no concuerda con el CUIT Ingresado',
              });
          }else{
              $("html, body").animate({
                  scrollTop: 0
              }, 600);
              activePanelNum++;
              setActiveStep(activePanelNum);
              setActivePanel(activePanelNum);
          }
      }else if(activePanelNum == 2){
          calle = $('#calle').val();
          nro_calle = $('#nro_calle').val();
          piso = $('#piso').val();
          depto = $('#depto').val();
          manzana = $('#manzana').val();
          casa = $('#casa').val();
          localidad = $('#localidad').val();
          departamento = $('#departamento').val();
          codigo_postal = $('#codigo_postal').val();

          if(!calle){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Ingrese la calle de su domicilio',
              });
          }else if(calle.length < 3){
              $.alert({
                  title: 'Advertencia!',
                  content: 'El nombre de la calle no debe tener menos de 3 caracteres',
              });
          }else if(!nro_calle){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Ingrese la numeración de su domicilio',
              });
          }else if(!localidad){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Ingrese la localidad de su domicilio',
              });
          }else if(localidad.length < 3){
              $.alert({
                  title: 'Advertencia!',
                  content: 'La localidad no debe tener menos de 3 caracteres',
              });
          }else if(!departamento){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Seleccione un departamento',
              });
          }else if(!codigo_postal){
              $.alert({
                  title: 'Advertencia!',
                  content: 'Ingrese su código postal de 4 dígitos',
              });
          }else if(codigo_postal.length != 4){
              $.alert({
                  title: 'Advertencia!',
                  content: 'El Código Postal debe contar con 4 dígitos',
              });
          }else{
              alert('finalizo');
          }
      }
          
    

  } 
  

});

  //SETTING PROPER FORM HEIGHT ONLOAD
  window.addEventListener('load', setFormHeight, true);

  //SETTING PROPER FORM HEIGHT ONRESIZE
  window.addEventListener('resize', setFormHeight, true);
})